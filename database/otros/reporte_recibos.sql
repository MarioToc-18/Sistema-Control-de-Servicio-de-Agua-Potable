USE `sisap`;
DROP procedure IF EXISTS `reporte_recibos`;

DELIMITER $$
USE `sisap`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `reporte_recibos`(
    IN param_fecha_inicial DATE,
    IN param_fecha_final DATE
)
BEGIN
    select 
        n2.*, 
        b.*
    from
        (select 
                n1.id_beneficiado,
                n1.numero_contador,
                n1.anio_lectura,
                sum(n1.enero) enero,
                sum(n1.febrero) febrero,
                sum(n1.marzo) marzo,
                sum(n1.abril) abril,
                sum(n1.mayo) mayo,
                sum(n1.junio) junio,
                sum(n1.julio) julio,
                sum(n1.agosto) agosto,
                sum(n1.septiembre) septiembre,
                sum(n1.octubre) octubre,
                sum(n1.noviembre) noviembre,
                sum(n1.diciembre) diciembre
            from 
                (select 
                    r.id_recibo, 
                    b.id_beneficiado,
                    bc.numero_contador,
                    r.mes_lectura, 
                    r.anio_lectura, 
                    (r.total - coalesce(r.cuota_pendiente,0, r.cuota_pendiente)) as consumo,
                    r.total as total,
                    r.esta_pagado,
                    (
                    CASE 
                        WHEN  r.mes_lectura = 1 and esta_pagado = true THEN 0
                        WHEN  r.mes_lectura = 1 and esta_pagado = false THEN (r.total - coalesce(r.cuota_pendiente,0, r.cuota_pendiente))
                        ELSE null
                    END) as enero,
                    (CASE 
                        WHEN  r.mes_lectura = 2 and esta_pagado = true THEN 0
                        WHEN  r.mes_lectura = 2 and esta_pagado = false THEN (r.total - coalesce(r.cuota_pendiente,0, r.cuota_pendiente))
                        ELSE null
                    END) as febrero,
                    (CASE 
                            WHEN  r.mes_lectura = 3 and esta_pagado = true THEN 0
                            WHEN  r.mes_lectura = 3 and esta_pagado = false THEN (r.total - coalesce(r.cuota_pendiente,0, r.cuota_pendiente))
                            ELSE null
                    END) as marzo,
                    (CASE 
                            WHEN  r.mes_lectura = 4 and esta_pagado = true THEN 0
                            WHEN  r.mes_lectura = 4 and esta_pagado = false THEN (r.total - coalesce(r.cuota_pendiente,0, r.cuota_pendiente))
                            ELSE null
                    END) as abril,
                    (CASE 
                            WHEN  r.mes_lectura = 5 and esta_pagado = true THEN 0
                            WHEN  r.mes_lectura = 5 and esta_pagado = false THEN (r.total - coalesce(r.cuota_pendiente,0, r.cuota_pendiente))
                            ELSE null
                    END) as mayo,
                    (CASE 
                            WHEN  r.mes_lectura = 6 and esta_pagado = true THEN 0
                            WHEN  r.mes_lectura = 6 and esta_pagado = false THEN (r.total - coalesce(r.cuota_pendiente,0, r.cuota_pendiente))
                            ELSE null
                    END) as junio,
                    (CASE 
                            WHEN  r.mes_lectura = 7 and esta_pagado = true THEN 0
                            WHEN  r.mes_lectura = 7 and esta_pagado = false THEN (r.total - coalesce(r.cuota_pendiente,0, r.cuota_pendiente))
                            ELSE null
                    END) as julio,
                    (CASE 
                            WHEN  r.mes_lectura = 8 and esta_pagado = true THEN 0
                            WHEN  r.mes_lectura = 8 and esta_pagado = false THEN (r.total - coalesce(r.cuota_pendiente,0, r.cuota_pendiente))
                            ELSE null
                    END) as agosto,
                    (CASE 
                            WHEN  r.mes_lectura = 9 and esta_pagado = true THEN 0
                            WHEN  r.mes_lectura = 9 and esta_pagado = false THEN (r.total - coalesce(r.cuota_pendiente,0, r.cuota_pendiente))
                            ELSE null
                    END) as septiembre,
                    (CASE 
                            WHEN  r.mes_lectura = 10 and esta_pagado = true THEN 0
                            WHEN  r.mes_lectura = 10 and esta_pagado = false THEN (r.total - coalesce(r.cuota_pendiente,0, r.cuota_pendiente))
                            ELSE null
                    END) as octubre,
                    (CASE 
                        WHEN  r.mes_lectura = 11 and esta_pagado = true THEN 0
                        WHEN  r.mes_lectura = 11 and esta_pagado = false THEN (r.total - coalesce(r.cuota_pendiente,0, r.cuota_pendiente))
                        ELSE null
                    END) as noviembre,
                    (CASE 
                        WHEN  r.mes_lectura = 12 and esta_pagado = true THEN 0
                        WHEN  r.mes_lectura = 12 and esta_pagado = false THEN (r.total - coalesce(r.cuota_pendiente,0, r.cuota_pendiente))
                        ELSE null
                    END) as diciembre
                from recibos r
                join beneficiados_contador bc on (r.id_beneficiado_contador = bc.id_beneficiado_contador)
                join beneficiados b on (bc.id_beneficiado = b.id_beneficiado)
                where r.fecha_lectura between param_fecha_inicial and param_fecha_final
                ) n1
            group by  n1.id_beneficiado, n1.numero_contador, n1.anio_lectura
        ) n2
    join beneficiados b on (n2.id_beneficiado = b.id_beneficiado);
 
END$$

DELIMITER ;

