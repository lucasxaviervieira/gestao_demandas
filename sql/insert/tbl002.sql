-- INSERIR DADOS NECESSÁRIOS PARA O SISTEMA FUNCIONAR

DO $$
DECLARE
    setor_cas_id INTEGER;
    setor_lcq_id INTEGER;
    setor_cga_id INTEGER;
BEGIN
	
    SELECT id INTO setor_cas_id FROM public."Setor" WHERE sigla = 'CAS';
    SELECT id INTO setor_lcq_id FROM public."Setor" WHERE sigla = 'LCQ';
    SELECT id INTO setor_cga_id FROM public."Setor" WHERE sigla = 'CGA';

    
    INSERT INTO public."Usuario" (nome_usuario, setor_id) VALUES
        ('patricia.karnopp', setor_cas_id),	
        ('glauber.cadorin', setor_lcq_id),
        ('alexsandra.moreira', setor_lcq_id),
        ('sabrina.farias', setor_cga_id),
        ('josiane.barbosa', setor_cga_id),
        ('rosemeri.correa', setor_cga_id),
        ('amanda.mello', setor_cga_id),
        ('leonardo.rech', setor_cga_id);

    
    RAISE NOTICE 'Tabela: Usuário; Inserção realizada com sucesso!';
END $$;

INSERT INTO public."Agente" (tipo, setor_id, ent_ext_id) VALUES
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

INSERT INTO public."Agente" (tipo, ent_ext_id, setor_id) VALUES
	('EXTERNO', 1, NULL),
	('EXTERNO', 2, NULL),
	('EXTERNO', 3, NULL);

INSERT INTO public."Atualizacao" (endereco_ip, usuario_id) 
	VALUES
	('127.0.0.1', 1);

INSERT INTO public."Correspondente" (agente_remetente_id, agente_destinatario_id) VALUES
	(1, 36);