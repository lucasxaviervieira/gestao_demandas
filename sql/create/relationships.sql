-- # CRIAÇÃO DOS RELACIONAMENTOS
-- ## CRIAÇÃO DA RELAÇÃO USUÁRIO e SETOR
ALTER TABLE Usuario
	ADD CONSTRAINT fk_setor FOREIGN KEY (setor_id)
        REFERENCES Setor (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID;

-- ## CRIAÇÃO DAS RELAÇÕES DE AGENTE
ALTER TABLE Agente
-- ### CRIAÇÃO DA RELAÇÃO com SETOR
	ADD CONSTRAINT fk_setor FOREIGN KEY (setor_id)
        REFERENCES Setor (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
	
-- ### CRIAÇÃO DA RELAÇÃO com ENTIDADE EXTERNA
	ADD CONSTRAINT fk_ent_ext FOREIGN KEY (ent_ext_id)
        REFERENCES Entidade_Externa (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID;

-- ## CRIAÇÃO DAS RELAÇÕES DE CORRESPONDENTE
ALTER TABLE Correspondente
-- ### CRIAÇÃO DA RELAÇÃO com AGENTE REMETENTE
	ADD CONSTRAINT fk_agente_remetente FOREIGN KEY (agente_remetente_id)
        REFERENCES Agente (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
	
-- ### CRIAÇÃO DA RELAÇÃO com AGENTE DESTINÁRIO
	ADD CONSTRAINT fk_agente_destinatario FOREIGN KEY (agente_destinatario_id)
        REFERENCES Agente (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
	
-- ### CRIAÇÃO DA RELAÇÃO com CONTROLE DE DEMANDA
	ADD CONSTRAINT fk_controle_demanda FOREIGN KEY (controle_demanda_id)
        REFERENCES Controle_Demanda (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID;

-- ## CRIAÇÃO DAS RELAÇÕES DE DEMANDA
ALTER TABLE Demanda
-- ### CRIAÇÃO DA RELAÇÃO com ATIVIDADE
	ADD CONSTRAINT fk_atividade FOREIGN KEY (atividade_id)
        REFERENCES Atividade (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
	
-- ### CRIAÇÃO DA RELAÇÃO com LOCALIZAÇÃO
	ADD CONSTRAINT fk_localizacao FOREIGN KEY (localizacao_id)
        REFERENCES Localizacao (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
	
-- ### CRIAÇÃO DA RELAÇÃO com SUBLOCALIDADE
	ADD CONSTRAINT fk_sublocalidade FOREIGN KEY (sublocalidade_id)
        REFERENCES Sublocalidade (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
	
-- ### CRIAÇÃO DA RELAÇÃO com OKR
	ADD CONSTRAINT fk_okr FOREIGN KEY (okr_id)
        REFERENCES Obj_Res_Cha (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,

-- ### CRIAÇÃO DA RELAÇÃO com TIPO
	ADD CONSTRAINT fk_tipo FOREIGN KEY (tipo_id)
        REFERENCES Tipo (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID;

-- ### CRIAÇÃO DAS RELAÇÕES DE PROCESSO_SEI
ALTER TABLE Processo_Sei
-- ### CRIAÇÃO DA RELAÇÃO com Demanda
	ADD CONSTRAINT fk_demanda FOREIGN KEY (demanda_id)
        REFERENCES Demanda (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID;

-- ### CRIAÇÃO DAS RELAÇÕES DE DOCUMENTO
ALTER TABLE Documento
-- ### CRIAÇÃO DA RELAÇÃO com Demanda
	ADD CONSTRAINT fk_demanda FOREIGN KEY (demanda_id)
        REFERENCES Demanda (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID;

-- ## CRIAÇÃO DAS RELAÇÕES DE CONTROLE DA DEMANDA
ALTER TABLE Controle_Demanda
-- ### CRIAÇÃO DA RELAÇÃO com USUÁRIO
	ADD CONSTRAINT fk_responsavel FOREIGN KEY (responsavel_id)
        REFERENCES Usuario (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,

-- ### CRIAÇÃO DA RELAÇÃO com DEMANDA
	ADD CONSTRAINT fk_demanda FOREIGN KEY (demanda_id)
        REFERENCES Demanda (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID;

-- ## CRIAÇÃO DAS RELAÇÕES DE ATUALIZAÇÃO
ALTER TABLE Atualizacao
-- ### CRIAÇÃO DA RELAÇÃO com USUÁRIO	
	ADD CONSTRAINT fk_usuario FOREIGN KEY (usuario_id)
        REFERENCES Usuario (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,

	-- ### CRIAÇÃO DA RELAÇÃO com CONTROLE DE DEMANDA
	ADD CONSTRAINT fk_controle_demanda FOREIGN KEY (controle_demanda_id)
        REFERENCES Controle_Demanda (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID;