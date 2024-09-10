-- # 1° INSERT (tbl001) 

SELECT * FROM public."Setor";

SELECT * FROM public."Entidade_Externa";
		
SELECT * FROM public."Situacao";
	
SELECT * FROM public."Atividade";

SELECT * FROM public."Localizacao";

SELECT * FROM public."Sublocalidade";
	
SELECT * FROM public."Tipo";
	
SELECT * FROM public."Obj_Res_Cha";

-- # 2° INSERT (tbl002)

-- ## Usuário
SELECT * FROM public."Usuario";
	
SELECT 
	u.nome_usuario,
	s.sigla AS setor_sigla,
	s.nome AS setor_nome 
FROM 
	public."Usuario" AS u,
	public."Setor" AS s
WHERE 
	u.setor_id = s.id;

-- ### Atualização
SELECT * FROM public."Atualizacao";

SELECT 
	a.id, a.endereco_ip, a.data_atualizacao, u.nome_usuario
FROM 
	public."Atualizacao" AS a, public."Usuario" AS u
WHERE
	a.usuario_id = u.id;

-- ## Agente
SELECT * FROM public."Agente";

-- ### Agente Interno
SELECT 
	a.id,
	a.tipo,
	s.sigla 
FROM 
	public."Agente" AS a,
	public."Setor" AS s
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
	public."Agente" AS a,
	public."Entidade_Externa" AS e
WHERE 
	a.super_id = e.id AND a.tipo = 'EXTERNO';

-- ## Demanda
SELECT * FROM public."Demanda";

SELECT 
    d.id,
    a.nome AS atividade_nome,
    l.nome AS localizacao_nome,
    s.nome AS sublocalidade_nome,
    t.nome AS tipo_nome,
    o.codigo AS okr_trimestre_ano
FROM 
    public."Demanda" d
JOIN 
    public."Atividade" AS a ON d.atividade_id = a.id
LEFT JOIN 
    public."Localizacao" AS l ON d.localizacao_id = l.id
LEFT JOIN 
    public."Sublocalidade" AS s ON d.sublocalidade_id = s.id
LEFT JOIN 
    public."Tipo" AS t ON d.tipo_id = t.id
LEFT JOIN 
    public."Obj_Res_Cha" AS o ON d.okr_id = o.id;

-- # 3° INSERT (tbl003)
SELECT * FROM public."Controle_Demanda";

SELECT
	cd.id,
	u.nome_usuario AS responsavel,
	s.descricao AS situacao,
	at.nome AS atividade_demanda
FROM 
	public."Controle_Demanda" AS cd
JOIN
	public."Usuario" AS u ON cd.responsavel_id = u.id 
LEFT JOIN
	public."Situacao" AS s ON cd.situacao_id = s.id
LEFT JOIN
	public."Demanda" AS d ON cd.demanda_id = d.id
LEFT JOIN
	public."Atividade" AS at ON d.atividade_id = at.id;

-- ### Correspondente
SELECT * FROM public."Correspondente";

SELECT 
	c.id,
	ra.tipo AS tipo_remetente,
	ra.super_id AS id_remetente,
	da.tipo AS tipo_destinatario,
	da.super_id AS id_destinatario,
	c.controle_demanda_id
FROM
	public."Correspondente" AS c
JOIN
	public."Agente" AS ra ON c.agente_remetente_id = ra.id
LEFT JOIN
	public."Agente" AS da ON c.agente_destinatario_id = da.id;