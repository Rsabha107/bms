SELECT msa.id,
	s.id broadcast_service_id,
    m.match_code,
    s.title AS service_name,
    msa.max_slots,
    msa.available_slots,
    msa.used_slots,
    msa.group_key
FROM match_service_availabilities msa
JOIN matches m ON msa.match_id = m.id
JOIN broadcast_services s ON msa.service_id = s.id
-- WHERE match_id = 1 AND service_id = 4
ORDER BY m.match_date, s.tivappuserstle;