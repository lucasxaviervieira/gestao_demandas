-- # 1° INSERT (tbl001) 

SELECT * FROM Setor;

SELECT * FROM Entidade_Externa;
		
SELECT * FROM Situacao;
	
SELECT * FROM Atividade;

SELECT * FROM Localizacao;

SELECT * FROM Sublocalidade;
	
SELECT * FROM Tipo;
	
SELECT * FROM Obj_Res_Cha;

-- # 2° INSERT (tbl002)

-- ## Usuário
SELECT * FROM Usuario;
	
SELECT 
	u.id,
	u.nome_usuario,
	s.sigla AS setor_sigla,
	s.nome AS setor_nome 
FROM 
	Usuario AS u,
	Setor AS s
WHERE 
	u.setor_id = s.id
ORDER BY
	s.sigla;

-- ## Agente
SELECT * FROM Agente;

-- ### Agente Interno
SELECT 
	a.id,
	a.tipo,
	s.sigla 
FROM 
	Agente AS a,
	Setor AS s
WHERE 
	a.super_id = s.id AND a.tipo = 'INTERNO';

-- ## Agente Externo
SELECT 
	a.id,
	a.tipo,
	e.sigla,
	a.nome_contato,
	fone_contato,
	email_contato
FROM 
	Agente AS a,
	Entidade_Externa AS e
WHERE 
	a.super_id = e.id AND a.tipo = 'EXTERNO';

-- ## Demanda
SELECT * FROM Demanda;

SELECT 
    d.id,
    a.nome AS atividade_nome,
    l.nome AS localizacao_nome,
    s.nome AS sublocalidade_nome,
    t.nome AS tipo_nome,
    o.codigo AS okr_trimestre_ano
FROM 
    Demanda d
JOIN 
    Atividade AS a ON d.atividade_id = a.id
LEFT JOIN 
    Localizacao AS l ON d.localizacao_id = l.id
LEFT JOIN 
    Sublocalidade AS s ON d.sublocalidade_id = s.id
LEFT JOIN 
    Tipo AS t ON d.tipo_id = t.id
LEFT JOIN 
    Obj_Res_Cha AS o ON d.okr_id = o.id;

-- # 3° INSERT (tbl003)
SELECT * FROM Controle_Demanda;
SELECT * FROM Controle_Demanda WHERE responsavel_id = 1;

SELECT
	cd.id,
	u.nome_usuario AS responsavel,
	s.descricao AS situacao,
	at.nome AS atividade_demanda
FROM 
	Controle_Demanda AS cd
JOIN
	Usuario AS u ON cd.responsavel_id = u.id 
LEFT JOIN
	Situacao AS s ON cd.situacao_id = s.id
LEFT JOIN
	Demanda AS d ON cd.demanda_id = d.id
LEFT JOIN
	Atividade AS at ON d.atividade_id = at.id;

-- ### Correspondente
SELECT * FROM Correspondente;

SELECT 
	c.id,
	ra.tipo AS tipo_remetente,
	ra.super_id AS remetente_id,
	da.tipo AS tipo_destinatario,
	da.super_id AS destinatario_id,
	c.controle_demanda_id
FROM
	Correspondente AS c
JOIN
	Agente AS ra ON c.agente_remetente_id = ra.id
LEFT JOIN
	Agente AS da ON c.agente_destinatario_id = da.id;

-- ### Atualização
SELECT * FROM Atualizacao;

SELECT * FROM Atualizacao ORDER BY data_atualizacao DESC LIMIT 1;

SELECT 
	a.id,
	a.endereco_ip,
	a.data_atualizacao,
	u.nome_usuario,
	a.controle_demanda_id		
FROM 
	Atualizacao AS a, Usuario AS u
WHERE
	a.usuario_id = u.id;