-- # 1° INSERT (tbl001) 

SELECT * FROM Setor;

SELECT * FROM Entidade_Externa;
		
SELECT * FROM Situacao;
	
SELECT * FROM Atividade;

SELECT * FROM Localizacao;

SELECT * FROM Sublocalidade;
	
SELECT * FROM Tipo;
	
SELECT * FROM Obj_Res_Cha;

SELECT * FROM Acesso_Diario;

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
	s.sigla, u.nome_usuario;

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
	e.sigla
FROM 
	Agente AS a,
	Entidade_Externa AS e
WHERE 
	a.super_id = e.id AND a.tipo = 'EXTERNO';

-- ### AMBOS
SELECT 
    a.id,
    COALESCE(s.sigla, ent.sigla) AS agente_sigla
FROM
	Agente AS a
LEFT JOIN 
    Setor AS s ON a.super_id = s.id AND a.tipo = 'INTERNO'
LEFT JOIN 
    Entidade_Externa AS ent ON a.super_id = ent.id AND a.tipo = 'EXTERNO';

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
    Obj_Res_Cha AS o ON d.okr_id = o.id
ORDER BY id;

-- Processo SEI
SELECT 
	* 
FROM 
	Processo_Sei
WHERE 
	demanda_id = 2;

-- Documento
SELECT 
	* 
FROM 
	Documento
WHERE 
	demanda_id = 2;

-- # 3° INSERT (tbl003)
-- ## Controle de Demanda
SELECT * FROM Controle_Demanda;
SELECT * FROM Controle_Demanda WHERE responsavel_id = 2;

-- ### select para a tela de demanda por ID
SELECT
	cd.id,
	at.nome AS atividade_demanda,
	at.codigo AS atividade_cod,
	l.nome AS localizacao_nome,
	sl.nome AS sublocalidade_nome,
	t.nome AS tipo_nome,
	s.descricao AS situacao,
	cd.*,
	d.observacao,
	o.codigo AS okr_trimestre_ano
FROM 
	Controle_Demanda AS cd
JOIN
	Usuario AS u ON cd.responsavel_id = u.id
LEFT JOIN
	Demanda AS d ON cd.demanda_id = d.id
LEFT JOIN 
	Localizacao AS l ON d.localizacao_id = l.id
LEFT JOIN 
	Sublocalidade AS sl ON d.sublocalidade_id = sl.id
LEFT JOIN 
	Tipo AS t ON d.tipo_id = t.id
LEFT JOIN
	Obj_Res_Cha AS o ON d.okr_id = o.id
LEFT JOIN
	Atividade AS at ON d.atividade_id = at.id
WHERE cd.id = 1
ORDER BY cd.data_criado DESC;

-- ### select para a tela de demandas por usuários
SELECT
	cd.id,
	at.nome AS atividade_demanda,
	l.nome AS localizacao_nome,
	sl.nome AS sublocalidade_nome,
	t.nome AS tipo_nome,
	cd.*,
	o.codigo AS okr_trimestre_ano
FROM 
	Controle_Demanda AS cd
JOIN
	Demanda AS d ON cd.demanda_id = d.id
LEFT JOIN 
	Localizacao AS l ON d.localizacao_id = l.id
LEFT JOIN 
	Sublocalidade AS sl ON d.sublocalidade_id = sl.id
LEFT JOIN 
	Tipo AS t ON d.tipo_id = t.id
LEFT JOIN
	Obj_Res_Cha AS o ON d.okr_id = o.id
LEFT JOIN
	Atividade AS at ON d.atividade_id = at.id
WHERE cd.responsavel_id = 1
ORDER BY cd.data_criado DESC;

-- ### select para a tela de demandas por setor
SELECT
	cd.id,
	u.nome_usuario AS responsavel_demanda,
	at.nome AS atividade_demanda,
	l.nome AS localizacao_nome,
	sl.nome AS sublocalidade_nome,
	t.nome AS tipo_nome,
	cd.status,
	cd.*,
	o.codigo AS okr_trimestre_ano
FROM 
	Controle_Demanda AS cd
JOIN
	Usuario AS u ON cd.responsavel_id = u.id
LEFT JOIN
	Demanda AS d ON cd.demanda_id = d.id
LEFT JOIN 
	Localizacao AS l ON d.localizacao_id = l.id
LEFT JOIN 
	Sublocalidade AS sl ON d.sublocalidade_id = sl.id
LEFT JOIN 
	Tipo AS t ON d.tipo_id = t.id
LEFT JOIN
	Obj_Res_Cha AS o ON d.okr_id = o.id
LEFT JOIN
	Atividade AS at ON d.atividade_id = at.id
WHERE u.setor_id = 20
ORDER BY cd.data_criado DESC;

-- ### Correspondente
SELECT * FROM Correspondente;

SELECT 
	c.id,
	ra.tipo AS tipo_remetente,
	ra.super_id AS remetente_id,
	da.tipo AS tipo_destinatario,
	da.super_id AS destinatario_id,
	c.data_respondido,
	c.controle_demanda_id
FROM
	Correspondente AS c
LEFT JOIN
	Agente AS ra ON c.agente_remetente_id = ra.id
LEFT JOIN
	Agente AS da ON c.agente_destinatario_id = da.id;

-- #### SELECT para pegar os correspondentes por controle de demanda
SELECT 
    c.id,
    COALESCE(r_s.sigla, r_ent.sigla) AS remetente_sigla,
    COALESCE(d_s.sigla, d_ent.sigla) AS destinatario_sigla, 
	c.data_respondido,
	c.controle_demanda_id
FROM
	Correspondente AS c
LEFT JOIN
	Agente AS ra ON c.agente_remetente_id = ra.id
LEFT JOIN
	Agente AS da ON c.agente_destinatario_id = da.id
LEFT JOIN 
    Setor r_s ON ra.super_id = r_s.id AND ra.tipo = 'INTERNO'
LEFT JOIN 
    Entidade_Externa r_ent ON ra.super_id = r_ent.id AND ra.tipo = 'EXTERNO'
LEFT JOIN 
    Setor d_s ON da.super_id = d_s.id AND da.tipo = 'INTERNO'
LEFT JOIN 
    Entidade_Externa d_ent ON da.super_id = d_ent.id AND da.tipo = 'EXTERNO'
WHERE c.controle_demanda_id = 10;



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

--  ### Pegar quantidade de demandas por setor
SELECT 
	s.id,
	s.sigla,
	count(1) as quantidade
FROM 
	Controle_Demanda AS cd
JOIN
	Usuario AS u ON u.id = cd.responsavel_id
LEFT JOIN 
	Setor AS s ON s.id = u.setor_id
GROUP BY 
	s.id,
	s.sigla
ORDER BY 
	quantidade DESC;