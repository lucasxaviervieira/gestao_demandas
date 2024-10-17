-- CARGA DE DADOS TESTE

-- DO $$
-- DECLARE
--     atividade_id INTEGER;
--     localizacao_id INTEGER;
--     sublocalidade_id INTEGER;
--     tipo_id INTEGER;
--     okr_id INTEGER;
-- BEGIN
	
--     SELECT id INTO atividade_id FROM Atividade WHERE codigo = 'APR_PRO';
--     SELECT id INTO localizacao_id FROM Localizacao WHERE codigo = 'ALM';
--     SELECT id INTO sublocalidade_id FROM Sublocalidade WHERE codigo = 'ADU';
--     SELECT id INTO tipo_id FROM Tipo WHERE codigo = 'ALV_CON';
--     SELECT id INTO okr_id FROM Obj_Res_Cha WHERE codigo = '1_2024';

    
--     INSERT INTO Demanda 
-- 		(
-- 		atividade_id,
-- 		localizacao_id,
-- 		sublocalidade_id,
-- 		tipo_id,
-- 		okr_id,
-- 		observacao
-- 		) VALUES
--         (atividade_id, localizacao_id, sublocalidade_id, tipo_id, null, 'teste');
    
--     RAISE NOTICE 'Tabela: Demanda; Inserção realizada com sucesso!';
-- END $$;

DO $$
DECLARE
    setor_cas_id INTEGER;
    setor_lcq_id INTEGER;
    setor_cga_id INTEGER;
    setor_gti_id INTEGER;
BEGIN
	
    SELECT id INTO setor_cas_id FROM Setor WHERE sigla = 'CAS';
    SELECT id INTO setor_lcq_id FROM Setor WHERE sigla = 'LCQ';
    SELECT id INTO setor_cga_id FROM Setor WHERE sigla = 'CGA';
    SELECT id INTO setor_gti_id FROM Setor WHERE sigla = 'GTI';


    INSERT INTO Usuario (nome_usuario, setor_id) VALUES
        ('patricia.karnopp', setor_cas_id),	
        ('glauber.cadorin', setor_lcq_id),
        ('alexsandra.moreira', setor_lcq_id),
        ('sabrina.farias', setor_cga_id),
        ('josiane.barbosa', setor_cga_id),
        ('rosemeri.correa', setor_cga_id),
        ('amanda.mello', setor_cga_id),
        ('leonardo.rech', setor_cga_id),
        ('lucas.vieira', setor_gti_id);

    
    RAISE NOTICE 'Tabela: Usuário; Inserção realizada com sucesso!';
END $$;

INSERT INTO Agente (tipo, setor_id, ent_ext_id) VALUES
	('INTERNO',1, NULL),
	('INTERNO',2, NULL),
	('INTERNO',3, NULL),
	('INTERNO',4, NULL),
	('INTERNO',5, NULL),
	('INTERNO',6, NULL),
	('INTERNO',7, NULL),
	('INTERNO',8, NULL),
	('INTERNO',9, NULL),
	('INTERNO',10, NULL),
	('INTERNO',11, NULL),
	('INTERNO',12, NULL),
	('INTERNO',13, NULL),
	('INTERNO',14, NULL),
	('INTERNO',15, NULL),
	('INTERNO',16, NULL),
	('INTERNO',17, NULL),
	('INTERNO',18, NULL),
	('INTERNO',19, NULL),
	('INTERNO',20, NULL),
	('INTERNO',21, NULL),
	('INTERNO',22, NULL),
	('INTERNO',23, NULL),
	('INTERNO',24, NULL),
	('INTERNO',25, NULL),
	('INTERNO',26, NULL),
	('INTERNO',27, NULL),
	('INTERNO',28, NULL),
	('INTERNO',29, NULL),
	('INTERNO',30, NULL),
	('INTERNO',31, NULL),
	('INTERNO',32, NULL),
	('INTERNO',33, NULL),
	('INTERNO',34, NULL),
	('INTERNO',35, NULL);

INSERT INTO Agente (tipo, ent_ext_id, setor_id) VALUES
	('EXTERNO', 1, NULL),
	('EXTERNO', 2, NULL),
	('EXTERNO', 3, NULL);

-- INSERT INTO Processo_Sei (referencia, descricao, demanda_id) VALUES
-- 	('28282828','', 1),
-- 	('27272727','', 1);

-- INSERT INTO Documento (referencia, descricao, demanda_id) VALUES
-- 	('21212121','', 1),
-- 	('22222222','teste', 1);