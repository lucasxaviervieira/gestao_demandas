-- CARGA DE DADOS TESTE

INSERT INTO Controle_Demanda 
	(
	prioridade,
	urgente,
	atrasado,
	data_inicio,
	data_concluido,
	prazo_conclusao,
	previsao_inicio,
	previsao_entrega,
	dias_iniciar,
	dias_concluir,
	dias_atrasado,
	prazo_dias,
	status,
	responsavel_id,
	situacao_id,
	demanda_id
	) VALUES 
	(1, false, false, '09/09/2024', '10/09/2024', '11/09/2024', '09/09/2024', '12/09/2024', '1', '2', '0', '3', 'ATIVO', 1,1,1),
	(1, false, false, '09/09/2024', '10/09/2024', '11/09/2024', '09/09/2024', '12/09/2024', '1', '2', '0', '3', 'ATIVO', 1,1,1),
	(1, false, false, '09/09/2024', '10/09/2024', '11/09/2024', '09/09/2024', '12/09/2024', '1', '2', '0', '3', 'ATIVO', 1,1,1),
	(1, false, false, '09/09/2024', '10/09/2024', '11/09/2024', '09/09/2024', '12/09/2024', '1', '2', '0', '3', 'ATIVO', 2,1,1),
	(1, false, false, '09/09/2024', '10/09/2024', '11/09/2024', '09/09/2024', '12/09/2024', '1', '2', '0', '3', 'ATIVO', 2,1,1),
	(1, false, false, '09/09/2024', '10/09/2024', '11/09/2024', '09/09/2024', '12/09/2024', '1', '2', '0', '3', 'ATIVO', 3,1,1);

INSERT INTO Correspondente (agente_remetente_id, agente_destinatario_id, controle_demanda_id) VALUES
	(4, 36, 1),
	(5, 37, 1),
	(6, 38, 1);

INSERT INTO Atualizacao (endereco_ip, usuario_id, controle_demanda_id)
	VALUES ('127.0.0.1', 1, 1);