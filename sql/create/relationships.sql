-- # CRIAÇÃO DOS RELACIONAMENTOS
-- ## CRIAÇÃO DA RELAÇÃO USUÁRIO e SETOR
ALTER TABLE public."Usuario"
	ADD CONSTRAINT fk_setor FOREIGN KEY (setor_id)
        REFERENCES public."Setor" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID;

-- ## CRIAÇÃO DAS RELAÇÕES DE AGENTE
ALTER TABLE public."Agente"
-- ### CRIAÇÃO DA RELAÇÃO DE AGENTE e SETOR
	ADD CONSTRAINT fk_setor FOREIGN KEY (setor_id)
        REFERENCES public."Setor" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
	
-- ### CRIAÇÃO DA RELAÇÃO DE AGENTE e ENTIDADE EXTERNA
	ADD CONSTRAINT fk_ent_ext FOREIGN KEY (ent_ext_id)
        REFERENCES public."Entidade_Externa" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID;

-- ## CRIAÇÃO DAS RELAÇÕES DE CORRESPONDENTE
ALTER TABLE public."Correspondente"
-- ### CRIAÇÃO DA RELAÇÃO DE CORRESPONDENTE e AGENTE REMETENTE
	ADD CONSTRAINT fk_agente_remetente FOREIGN KEY (agente_remetente_id)
        REFERENCES public."Agente" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
	
-- ### CRIAÇÃO DA RELAÇÃO DE CORRESPONDENTE e AGENTE DESTINÁRIO
	ADD CONSTRAINT fk_agente_destinatario FOREIGN KEY (agente_destinatario_id)
        REFERENCES public."Agente" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID;

-- ## CRIAÇÃO DAS RELAÇÕES DE DEMANDA
ALTER TABLE public."Demanda"
-- ### CRIAÇÃO DA RELAÇÃO DE DEMANDA e ATIVIDADE
	ADD CONSTRAINT fk_atividade FOREIGN KEY (atividade_id)
        REFERENCES public."Atividade" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
	
-- ### CRIAÇÃO DA RELAÇÃO DE DEMANDA e SISTEMA
	ADD CONSTRAINT fk_localizacao FOREIGN KEY (localizacao_id)
        REFERENCES public."Localizacao" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
	
-- ### CRIAÇÃO DA RELAÇÃO DE DEMANDA e SERVICO
	ADD CONSTRAINT fk_sublocalidade FOREIGN KEY (sublocalidade_id)
        REFERENCES public."Sublocalidade" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
	
-- ### CRIAÇÃO DA RELAÇÃO DE DEMANDA e OKR
	ADD CONSTRAINT fk_okr FOREIGN KEY (okr_id)
        REFERENCES public."Obj_Res_Cha" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,

-- ### CRIAÇÃO DA RELAÇÃO DE DEMANDA e TIPO
	ADD CONSTRAINT fk_tipo FOREIGN KEY (tipo_id)
        REFERENCES public."Tipo" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
	
-- ### CRIAÇÃO DA RELAÇÃO DE DEMANDA e REFERÊNCIA EXTERNA
	ADD CONSTRAINT fk_referencia_externa FOREIGN KEY (referencia_externa_id)
        REFERENCES public."Referencia_Externa" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID;

-- ## CRIAÇÃO DAS RELAÇÕES DE CONTROLE DA DEMANDA
ALTER TABLE public."Controle_Demanda"
-- ### CRIAÇÃO DA RELAÇÃO DE CONTROLE DA DEMANDA e USUÁRIO
	ADD CONSTRAINT fk_responsavel FOREIGN KEY (responsavel_id)
        REFERENCES public."Usuario" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
	
-- ### CRIAÇÃO DA RELAÇÃO DE CONTROLE DA DEMANDA e SITUAÇÃO
	ADD CONSTRAINT fk_situacao FOREIGN KEY (situacao_id)
        REFERENCES public."Situacao" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,

-- ### CRIAÇÃO DA RELAÇÃO DE CONTROLE DA DEMANDA e DEMANDA
	ADD CONSTRAINT fk_demanda FOREIGN KEY (demanda_id)
        REFERENCES public."Demanda" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,

-- ### CRIAÇÃO DA RELAÇÃO DE CONTROLE DA DEMANDA e CORRESPONDENTE	
	ADD CONSTRAINT fk_correspondente FOREIGN KEY (correspondente_id)
        REFERENCES public."Correspondente" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,

-- ### CRIAÇÃO DA RELAÇÃO DE CONTROLE DA DEMANDA e ATUALIZACAO	
	ADD CONSTRAINT fk_ultima_atualizacao FOREIGN KEY (ultima_atualizacao_id)
        REFERENCES public."Atualizacao" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID;