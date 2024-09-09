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

-- ## Agente
SELECT * FROM public."Agente";

-- ### Agente Interno
SELECT 
	a.setor_id AS id,
	a.tipo,
	s.sigla 
	FROM 
		public."Agente" AS a,
		public."Setor" AS s
	WHERE 
		a.setor_id = s.id;

-- ### Agente Externo
SELECT 
	a.ent_ext_id AS id,
	a.tipo,
	e.sigla,
	a.nome_contato,
	fone_contato,
	email_contato
	FROM 
		public."Agente" AS a,
		public."Entidade_Externa" AS e
	WHERE 
		a.ent_ext_id = e.id;

-- # 3° INSERT (tbl003)

-- ## Demanda
SELECT * FROM public."Demanda";

SELECT 
    d.id AS demanda_id,
    a.nome AS atividade_nome,
    l.nome AS localizacao_nome,
    s.nome AS sublocalidade_nome,
    t.nome AS tipo_nome,
    o.codigo AS okr_trimestre_ano
FROM 
    public."Demanda" d
JOIN 
    public."Atividade" a ON d.atividade_id = a.id
LEFT JOIN 
    public."Localizacao" l ON d.localizacao_id = l.id
LEFT JOIN 
    public."Sublocalidade" s ON d.sublocalidade_id = s.id
LEFT JOIN 
    public."Tipo" t ON d.tipo_id = t.id
LEFT JOIN 
    public."Obj_Res_Cha" o ON d.okr_id = o.id;