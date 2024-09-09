-- # RESTRIÇÕES ESPECIAIS

-- ## FUNÇÕES
-- ### TRIGGER PARA (DEMANDA -> ATIVIDADE)
CREATE OR REPLACE FUNCTION trg_check_okr_id_constraint()
RETURNS TRIGGER AS
$$
DECLARE
    codigo_atividade varchar(12);
BEGIN
    -- Obter o código da atividade da linha que está sendo inserida/atualizada
    SELECT a.codigo INTO codigo_atividade
    FROM public."Atividade" a
    WHERE a.id = NEW.atividade_id;

    -- Verifica se a atividade é OKR
    IF codigo_atividade = 'OKR' THEN
        -- Se a atividade for OKR, o campo okr_id não pode ser nulo
        IF NEW.okr_id IS NULL THEN
            RAISE EXCEPTION 'O campo okr_id não pode ser nulo quando a atividade for OKR';
        END IF;
    ELSE
        -- Se a atividade não for OKR, o campo okr_id deve ser nulo
        IF NEW.okr_id IS NOT NULL THEN
            RAISE EXCEPTION 'O campo okr_id deve ser nulo quando a atividade não for OKR';
        END IF;
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- ## TABELA DEMANDA
-- ### CRIAÇÃO DA RESTRIÇÃO PARA A TABELA DEMANDA
CREATE TRIGGER trg_check_okr_id
	BEFORE INSERT OR UPDATE ON public."Demanda"
	FOR EACH ROW
	EXECUTE FUNCTION trg_check_okr_id_constraint();

-- ## TABELA AGENTE
-- ### CRIAÇÃO DA RESTRIÇÃO PARA AS CHAVES ESTRANGEIRAS DA TABELA AGENTE
ALTER TABLE public."Agente"
	ADD CONSTRAINT chk_tipo_agente CHECK (
    (tipo = 'INTERNO' AND setor_id IS NOT NULL AND ent_ext_id IS NULL)
    OR tipo = 'EXTERNO' AND ent_ext_id IS NOT NULL AND setor_id IS NULL
	);