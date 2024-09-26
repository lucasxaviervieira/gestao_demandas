-- # CRIAÇÃO DAS ENTIDADES
-- ## CRIAÇÃO DA ENTIDADE SETOR
CREATE TABLE IF NOT EXISTS Setor 
(
	id serial NOT NULL,
	sigla varchar(12) UNIQUE NOT NULL,
	nome varchar(150) NOT NULL,
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE Entidade Externa
CREATE TABLE IF NOT EXISTS Entidade_Externa 
(
	id serial NOT NULL,
	sigla varchar(12) UNIQUE NOT NULL,
	nome varchar(150) NOT NULL,
	possessor varchar(150) DEFAULT NULL,
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE AGENTE
CREATE TABLE IF NOT EXISTS Agente 
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
CREATE TABLE IF NOT EXISTS Correspondente 
(
	id serial NOT NULL,
	agente_remetente_id integer,
	agente_destinatario_id integer,
	controle_demanda_id integer NOT NULL,
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE USUÁRIO
CREATE TABLE IF NOT EXISTS Usuario 
(
	id serial NOT NULL,
	nome_usuario varchar(50) NOT NULL,
	setor_id integer NOT NULL,
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE SITUAÇÃO
CREATE TABLE IF NOT EXISTS Situacao 
(
	id serial NOT NULL,
	codigo varchar(12) NOT NULL UNIQUE CHECK (codigo IN ('AGU', 'AND', 'CON', 'DES', 'NAO', 'RES')),
	descricao varchar(50) NOT NULL,
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE SISTEMA
CREATE TABLE IF NOT EXISTS Localizacao 
(
	id serial NOT NULL,
    codigo varchar(12) NOT NULL UNIQUE,
	nome varchar(50) NOT NULL,
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE RESTANTE
CREATE TABLE IF NOT EXISTS Sublocalidade 
(
	id serial NOT NULL,
    codigo varchar(12) NOT NULL UNIQUE,
	nome varchar(50) NOT NULL,
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE OBJETIVO
CREATE TABLE IF NOT EXISTS Obj_Res_Cha 
(
	id serial NOT NULL,
    codigo varchar(12) NOT NULL UNIQUE,
	trimestre smallint NOT NULL CHECK (trimestre IN (1, 2, 3, 4)),
	ano char(4) NOT NULL,
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE TIPO
CREATE TABLE IF NOT EXISTS Tipo 
(
	id serial NOT NULL,
    codigo varchar(12) NOT NULL UNIQUE,
	nome varchar(50) NOT NULL,
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE PROCESSO SEI
CREATE TABLE IF NOT EXISTS Processo_Sei
(
	id serial NOT NULL,
	referencia varchar(50),
	descricao varchar(255),
	demanda_id integer,
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE DOCUMENTO
CREATE TABLE IF NOT EXISTS Documento
(
	id serial NOT NULL,
	referencia varchar(50),
	descricao varchar(255),
	demanda_id integer,
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE DEMANDA
CREATE TABLE IF NOT EXISTS Atividade
(
    id serial NOT NULL,
    codigo varchar(12) NOT NULL UNIQUE CHECK (codigo IN ('ANA_AMB', 'APR_PRO', 'CON_PEN', 'CON_SER', 'DIV', 'MAT_CON', 'MAT_LIC', 'OFI', 'OKR', 'PAR_CON_AMB', 'REL_CON', 'VIS')),
    nome varchar(150) NOT NULL,
    PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE DEMANDA
CREATE TABLE IF NOT EXISTS Demanda
(
    id serial NOT NULL,
    atividade_id integer NOT NULL,
    localizacao_id integer,
    sublocalidade_id integer,
    tipo_id integer,
    okr_id integer,
    observacao varchar(500),
    PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE CONTROLE DA DEMANDA
CREATE TABLE IF NOT EXISTS Controle_Demanda 
(
	id serial NOT NULL,
	status varchar(12) NOT NULL CHECK (status IN ('ATIVO', 'CANCELADO')),
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
	responsavel_id integer NOT NULL,
	situacao_id integer NOT NULL,
	demanda_id integer NOT NULL,
	PRIMARY KEY (id)
);

-- ## CRIAÇÃO DA ENTIDADE ATUALIZAÇÃO
CREATE TABLE IF NOT EXISTS Atualizacao 
(
	id serial NOT NULL,
    endereco_ip varchar(15) NOT NULL,
	data_atualizacao timestamp NOT NULL DEFAULT now(),
	usuario_id integer NOT NULL,
	controle_demanda_id integer NOT NULL,
	PRIMARY KEY (id)
);

-- # OWNER to postgres
ALTER TABLE IF EXISTS Setor 
	OWNER TO postgres;
ALTER TABLE IF EXISTS Entidade_Externa 
	OWNER TO postgres;
ALTER TABLE IF EXISTS Agente 
	OWNER TO postgres;
ALTER TABLE IF EXISTS Correspondente 
	OWNER TO postgres;
ALTER TABLE IF EXISTS Usuario 
	OWNER TO postgres;
ALTER TABLE IF EXISTS Situacao 
	OWNER TO postgres;
ALTER TABLE IF EXISTS Localizacao 
	OWNER TO postgres;
ALTER TABLE IF EXISTS Sublocalidade 
	OWNER TO postgres;
ALTER TABLE IF EXISTS Obj_Res_Cha 
	OWNER TO postgres;
ALTER TABLE IF EXISTS Tipo 
	OWNER TO postgres;
ALTER TABLE IF EXISTS Processo_Sei 
	OWNER TO postgres;
ALTER TABLE IF EXISTS Documento 
	OWNER TO postgres;
ALTER TABLE IF EXISTS Atividade 
	OWNER TO postgres;
ALTER TABLE IF EXISTS Demanda 
	OWNER TO postgres;
ALTER TABLE IF EXISTS Controle_Demanda 
	OWNER TO postgres;
ALTER TABLE IF EXISTS Atualizacao 
	OWNER TO postgres;