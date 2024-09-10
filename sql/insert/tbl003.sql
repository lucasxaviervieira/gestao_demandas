DO $$
DECLARE
    atividade_id INTEGER;
    localizacao_id INTEGER;
    sublocalidade_id INTEGER;
    tipo_id INTEGER;
    -- referencia_externa_id INTEGER;
    okr_id INTEGER;
BEGIN
	
    SELECT id INTO atividade_id FROM public."Atividade" WHERE codigo = 'OKR';
    SELECT id INTO localizacao_id FROM public."Localizacao" WHERE codigo = 'ALM';
    SELECT id INTO sublocalidade_id FROM public."Sublocalidade" WHERE codigo = 'ADU';
    SELECT id INTO tipo_id FROM public."Tipo" WHERE codigo = 'ALV_CON';
    -- SELECT id INTO referencia_externa_id FROM public."Referencia_Externa" WHERE codigo = 'CGA';
    SELECT id INTO okr_id FROM public."Obj_Res_Cha" WHERE codigo = '1_2024';

    
    INSERT INTO public."Demanda" 
		(
		atividade_id,
		localizacao_id,
		sublocalidade_id,
		tipo_id,
		referencia_externa_id,
		okr_id
		) VALUES
        (atividade_id, localizacao_id, sublocalidade_id, tipo_id, null, okr_id);

    
    RAISE NOTICE 'Tabela: Demanda; Inserção realizada com sucesso!';
END $$;