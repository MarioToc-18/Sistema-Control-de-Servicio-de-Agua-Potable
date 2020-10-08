-- conseguir total factura anterior
-- conseguir consumo anterior
-- generar consumo_mes
-- obtener total tabla tasas_agua
-- generar anio y mes de lectura
-- generar esta_trasladado a recibo anterior
-- generar nuevo total
-- generar insert de nuevo recibo
-- registrar nuevo traslado
-- update ultimo recibo a trasladado
-- return new.id_recibo

USE `sisap`;
DROP procedure IF EXISTS `generar_recibo`;

DELIMITER $$
USE `sisap`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `generar_recibo`(

    IN param_id INT,
    IN param_fecha DATE,
    IN param_lectura_actual INT
)
BEGIN 
    DECLARE id_ultimo_recibo INT;
    DECLARE id_recibo_nuevo INT;
    DECLARE lectura_anterior INT;
    DECLARE lectura_mes INT;
    DECLARE lectura_exceso INT;
    DECLARE tasa_minima INT; 
    DECLARE tasa_maxima INT;
    DECLARE numero_recibo INT;
    DECLARE cuota_fija DECIMAL(12,2);
    DECLARE cuota_pendiente DECIMAL(12,2);
    DECLARE consumo_exceso DECIMAL(12,2);
    DECLARE consumo_mes DECIMAL(12,2);
    DECLARE total_recibo DECIMAL(12,2);
    DECLARE estado_ultima_factura BOOLEAN;
    START TRANSACTION;

        SET cuota_fija = 10.00;
        SET consumo_exceso = null;
        SET estado_ultima_factura = TRUE;

        SELECT id_recibo FROM recibos WHERE id_beneficiado_contador = param_id ORDER BY id_recibo DESC LIMIT 1 into id_ultimo_recibo;
        SELECT COALESCE(max(numero),0) + 1 FROM recibos into numero_recibo;
        
        IF id_ultimo_recibo IS NULL THEN 
            -- PRIMER RECIBO
            SET lectura_anterior = null;
            SET cuota_pendiente = null;

        ELSE
            -- YA EXISTE RECIBO GENERADO
            SELECT esta_pagado FROM recibos WHERE id_beneficiado_contador = param_id ORDER BY id_recibo DESC LIMIT 1 into estado_ultima_factura;
            SELECT lectura_actual FROM recibos WHERE id_recibo = id_ultimo_recibo into lectura_anterior;

            IF estado_ultima_factura = TRUE THEN
                -- TODOS LOS RECIBOS ESTAN PAGADOS
                SET cuota_pendiente = null;
            ELSE
                -- ULTIMO RECIBO PENDIENTE DE PAGO
                SELECT total FROM recibos WHERE id_recibo = id_ultimo_recibo AND esta_pagado = false AND esta_trasladado = false into cuota_pendiente;
            END IF;    
        END IF;

        SELECT (param_lectura_actual -  COALESCE(lectura_anterior,0)) into lectura_mes;
        SELECT COALESCE(min(medida),0) FROM tasas_agua into tasa_minima;

        IF lectura_mes = 0 THEN 
            SET consumo_mes = 0.00;
        ELSEIF lectura_mes < tasa_minima THEN
            SET consumo_mes = (SELECT COALESCE(min(total),0) FROM tasas_agua limit 1);
        ELSE
            -- SELECCIONAR MAXIMA MEDIDA = 100,000
            SELECT COALESCE(max(medida),0) FROM tasas_agua into tasa_maxima;
            -- LECTURA EN EXCESO
            SET lectura_exceso = (lectura_mes-tasa_maxima);
            
            -- VERIFICAR LECTURA EN EXCESO
            IF lectura_exceso > 0 THEN
                -- CALCULAR CONSUMO EXCESO
                SELECT total FROM tasas_agua WHERE medida >= lectura_exceso limit 1 into consumo_exceso;

                -- SI NO ENCUENTRA NINGÚN REGISTRO (MAYOR A MAXIMA MEDIDA)
                IF consumo_exceso IS NULL THEN
                    SELECT COALESCE(max(total),0) FROM tasas_agua into consumo_exceso;
                END IF;

                SET lectura_mes = lectura_mes - lectura_exceso;
            ELSE
                SET consumo_exceso = null;
            END IF;

            -- CALCULO CONSUMO CON MEDIDA MAXIMA O MENOR
            SELECT total FROM tasas_agua WHERE medida >= lectura_mes limit 1 into consumo_mes;
            
        END IF;

        

        SELECT (cuota_fija + COALESCE(consumo_exceso,0) +COALESCE(cuota_pendiente,0) + consumo_mes) into total_recibo;
        
        INSERT INTO recibos(id_beneficiado_contador,fecha_lectura,anio_lectura,mes_lectura,fecha_max_pago,serie,numero,lectura_anterior,lectura_actual,cuota_fija,consumo,exceso,cuota_pendiente,total,fecha_efectiva,esta_trasladado,esta_pagado,esta_eliminado,created_at,updated_at)
        VALUES(
            param_id,
            param_fecha,
            YEAR(param_fecha),
            MONTH(param_fecha),
            DATE_ADD(param_fecha, INTERVAL 15 DAY),
            'A',
            numero_recibo,
            lectura_anterior,
            param_lectura_actual,
            cuota_fija,
            consumo_mes,
            consumo_exceso,
            cuota_pendiente,
            total_recibo,
            null,
            0,
            0,
            0,
            now(),
            now()
        );

        -- RECIBO NUEVO
        SELECT id_recibo FROM recibos WHERE numero = numero_recibo limit 1 into id_recibo_nuevo;

        IF id_ultimo_recibo IS NOT NULL THEN 
            IF estado_ultima_factura = FALSE THEN
                -- ULTIMO RECIBO PENDIENTE DE PAGO
                UPDATE recibos  SET esta_trasladado = true  WHERE id_recibo = id_ultimo_recibo;
                INSERT INTO recibos_traslado(id_recibo_original,id_recibo_nuevo,fecha_transaccion,created_at,updated_at)
                VALUES(id_ultimo_recibo, id_recibo_nuevo, CURDATE(), now(),now());
            END IF;  
        END IF;
    
    COMMIT;

    SELECT * FROM recibos WHERE id_recibo = id_recibo_nuevo;

END$$

DELIMITER ;

