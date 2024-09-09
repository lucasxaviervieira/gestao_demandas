-- # PRIMEIRO INSERT

SELECT * FROM public."Setor";

SELECT * FROM public."Entidade_Externa";
		
SELECT * FROM public."Situacao";
	
SELECT * FROM public."Atividade";

SELECT * FROM public."Localizacao";

SELECT * FROM public."Sublocalidade";
	
SELECT * FROM public."Obj_Res_Cha";
	
SELECT * FROM public."Tipo";

-- # SEGUNDO INSERT

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