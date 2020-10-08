SELECT 
	b.id_beneficiado,
	b.nit,
	CONCAT_WS(' ',b.nombre1,b.nombre2,b.apellido1,b.apellido2) as nombre_completo,
	b.telefono,
	bc.numero_contador,
	det.recibos_pendiente,
    sum(ifnull(cuota_fija,0)+ifnull(consumo,0)+ifnull(exceso,0)) as monto_pendiente
FROM
(
	SELECT 
		id_beneficiado_contador, 
        count(1) as recibos_pendiente,
        sum(cuota_fija) as cuota_fija,
        sum(consumo) as consumo,
        sum(exceso) as exceso
	FROM recibos
	WHERE esta_pagado = false
	GROUP BY id_beneficiado_contador
) det
JOIN beneficiados_contador bc on det.id_beneficiado_contador = bc.id_beneficiado_contador
JOIN beneficiados b on bc.id_beneficiado = b.id_beneficiado
ORDER BY id_beneficiado, numero_contador;