-- # CRIAÇÃO DAS ENTIDADES
-- ## CRIAÇÃO DA ENTIDADE SETOR
CREATE TABLE IF NOT EXISTS public."Setor" 
(
	id serial NOT NULL,
	sigla varchar(12) UNIQUE NOT NULL,
	nome varchar(150) NOT NULL,
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE Entidade Externa
CREATE TABLE IF NOT EXISTS public."Entidade_Externa" 
(
	id serial NOT NULL,
	sigla varchar(12) UNIQUE NOT NULL,
	nome varchar(150) NOT NULL,
	possessor varchar(150) DEFAULT NULL,
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE AGENTE
CREATE TABLE IF NOT EXISTS public."Agente" 
(
	id serial NOT NULL,
	tipo char(7) NOT NULL CHECK (tipo IN ('INTERNO', 'EXTERNO')),
	nome_contato varchar(150),
	fone_contato varchar(20),
	email_contato varchar(150),
	setor_id integer,
	ent_ext_id integer,
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE CORRESPONDENTE
CREATE TABLE IF NOT EXISTS public."Correspondente" 
(
	id serial NOT NULL,
	agente_remetente_id integer,
	agente_destinatario_id integer,
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE USUÁRIO
CREATE TABLE IF NOT EXISTS public."Usuario" 
(
	id serial NOT NULL,
	nome_usuario varchar(50) NOT NULL,
	setor_id integer NOT NULL,
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE SITUAÇÃO
CREATE TABLE IF NOT EXISTS public."Situacao" 
(
	id serial NOT NULL,
	codigo varchar(12) NOT NULL UNIQUE CHECK (codigo IN ('AGU', 'AND', 'CON', 'DES', 'NAO', 'RES')),
	descricao varchar(50) NOT NULL,
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE SISTEMA
CREATE TABLE IF NOT EXISTS public."Localizacao" 
(
	id serial NOT NULL,
    codigo varchar(12) NOT NULL UNIQUE,
	nome varchar(50) NOT NULL,
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE RESTANTE
CREATE TABLE IF NOT EXISTS public."Sublocalidade" 
(
	id serial NOT NULL,
    codigo varchar(12) NOT NULL UNIQUE,
	nome varchar(50) NOT NULL,
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE OBJETIVO
CREATE TABLE IF NOT EXISTS public."Obj_Res_Cha" 
(
	id serial NOT NULL,
    codigo varchar(12) NOT NULL UNIQUE,
	trimestre smallint NOT NULL CHECK (trimestre IN (1, 2, 3, 4)),
	ano char(4) NOT NULL,
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE TIPO
CREATE TABLE IF NOT EXISTS public."Tipo" 
(
	id serial NOT NULL,
    codigo varchar(12) NOT NULL UNIQUE,
	nome varchar(50) NOT NULL,
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE REFERÊNCIA EXTERNA
CREATE TABLE IF NOT EXISTS public."Referencia_Externa"
(
	id serial NOT NULL,
	n_sei varchar(50),
	n_documento varchar(50),
	descricao_sei varchar(255),
	descricao_doc varchar(255),	
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE DEMANDA
CREATE TABLE IF NOT EXISTS public."Atividade"
(
    id serial NOT NULL,
    codigo varchar(12) NOT NULL UNIQUE CHECK (codigo IN ('ANA_AMB', 'APR_PRO', 'CON_PEN', 'CON_SER', 'DIV', 'MAT_CON', 'MAT_LIC', 'OFI', 'OKR', 'PAR_CON_AMB', 'REL_CON', 'VIS')),
    nome varchar(150) NOT NULL,
    PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE DEMANDA
CREATE TABLE IF NOT EXISTS public."Demanda"
(
    id serial NOT NULL,
    atividade_id integer NOT NULL,
    localizacao_id integer,
    sublocalidade_id integer,
    tipo_id integer,
    referencia_externa_id integer,
    okr_id integer,
    PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE CONTROLE DA DEMANDA
CREATE TABLE IF NOT EXISTS public."Controle_Demanda" 
(
	id serial NOT NULL,
	prioridade smallint,
	urgente boolean NOT NULL,
	atrasado boolean NOT NULL,
	data_criado timestamp NOT NULL DEFAULT now(),
	data_inicio date,
	data_concluido date,
	prazo_conclusao date,
	previsao_inicio date,
	previsao_entrega date,
	dias_iniciar smallint,
	dias_concluir smallint,
	dias_atrasado smallint,
	prazo_dias smallint,	
	status varchar(12) NOT NULL CHECK (status IN ('ATIVO', 'CANCELADO')),
	responsavel_id integer NOT NULL,
	situacao_id integer NOT NULL,
	demanda_id integer NOT NULL,
	correspondente_id integer,
	ultima_atualizacao_id integer NOT NULL,	
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE ATUALIZAÇÃO
CREATE TABLE IF NOT EXISTS public."Atualizacao" 
(
	id serial NOT NULL,
    endereco_ip varchar(15) NOT NULL,
	data_atualizacao timestamp NOT NULL DEFAULT now(),
	usuario_id integer,
	PRIMARY KEY (id)
);

-- # OWNER to postgres
ALTER TABLE IF EXISTS public."Agente"
    OWNER to postgres;
ALTER TABLE IF EXISTS public."Atividade"
    OWNER to postgres;
ALTER TABLE IF EXISTS public."Atualizacao"
    OWNER to postgres;
ALTER TABLE IF EXISTS public."Controle_Demanda"
    OWNER to postgres;
ALTER TABLE IF EXISTS public."Correspondente"
    OWNER to postgres;
ALTER TABLE IF EXISTS public."Demanda"
    OWNER to postgres;
ALTER TABLE IF EXISTS public."Entidade_Externa"
    OWNER to postgres;
ALTER TABLE IF EXISTS public."Referencia_Externa"
    OWNER to postgres;
ALTER TABLE IF EXISTS public."Setor"
    OWNER to postgres;
ALTER TABLE IF EXISTS public."Localizacao"
    OWNER to postgres;
ALTER TABLE IF EXISTS public."Situacao"
    OWNER to postgres;
ALTER TABLE IF EXISTS public."Sublocalidade"
    OWNER to postgres;
ALTER TABLE IF EXISTS public."Tipo"
    OWNER to postgres;
ALTER TABLE IF EXISTS public."Usuario"
    OWNER to postgres;