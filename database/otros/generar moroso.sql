SELECT 
	b.nit,
	CONCAT_WS(' ',b.nombre1,b.nombre2,b.apellido1,b.apellido2) as nombre_completo,
	b.telefono,
	bc.numero_contador,
	det.total
FROM
(
SELECT id_beneficiado_contador, count(1) as total FROM recibos
WHERE esta_pagado = false
GROUP BY id_beneficiado_contador) det
JOIN beneficiados_contador bc on det.id_beneficiado_contador = bc.id_beneficiado_contador
JOIN beneficiados b on bc.id_beneficiado = b.id_beneficiado
ORDER BY total DESC LIMIT 5;