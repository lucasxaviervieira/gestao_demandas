-- CARGA DE DADOS NECESSÁRIAS PARA O SISTEMA FUNCIONAR

INSERT INTO public."Setor" (sigla, nome) VALUES
	('GFI', 'Gerência Financeira'),
	('GGP', 'Gerência de Gestão de Pessoas'),
	('GSL', 'Gerência de Suprimentos Logística'),
	('GRI', 'Gerência de Riscos, Conformidade, Controle Interno e Inovação'),
	('GTI', 'Gerência de Tecnologia de Informação'),
	('ACRM', 'Assessoria de Comunicação, Relacionamento e Marketing'),
	('AJUD', 'Assessoria Jurídica'),
	('AUDI', 'Auditoria'),
	('CIOP', 'Centro de Inteligência em Operações'),
	('EPP', 'Escritoria de Projetos e Processos'),
	('GFC', 'Gerência de Faturamento e Gestão Comercial'),
	('SGC', 'Secretaria de Governança Coorporativa'),
	('CME', 'Coordenação de Melhorias de Estruturas'),
	('GAG', 'Gerência de Água'),
	('GES', 'Gerência de Esgoto'),
	('GMS', 'Gerência de Manutenção e Serviços'),
	('GEX', 'Gerência de Expansão'),
	('GQM', 'Gerência de Qualidade e Meio Ambiente'),
	('CGA', 'Coordenação de Gestão Ambiental'),
	('CAS', 'Coordenação de Planejamento e Controle Ambiental e Social'),
	('LCQ', 'Coordenação de Laboratório de Controle de Qualidade'),
	('CPEX1', 'Coordenação de Projetos de Expansão 1'),
	('CPEX2', 'Coordenação de Projetos de Expansão 2'),
	('CPEX3', 'Coordenação de Projetos de Expansão 3'),
	('CPEX4', 'Coordenação de Projetos de Expansão 4'),
	('CPP', 'Coordenação de Planej. e Projetos Complementares'),
	('CPC', 'Coordenação de Planej. e Gestão de Contratos e Conv.'),
	('CLC', 'Coordenação de Licitações e Compras'),
	('CCT', 'Coordenação de Coleta e Transporte'),
	('CTR', 'Coordenação de Tratamento'),
	('CSS', 'Coordenação de Saúde e Segurança Ocupacional'),
	('CRE', 'Coord. de Responsab. Social e Experiência do Cliente'),
	('CEM', 'Coordenação Eletromecanica'),
	('CGE', 'Coordenação de Gestão de Energia e Efic. Energética'),
	('CPR', 'Coordenação de Produção');

INSERT INTO public."Entidade_Externa" (sigla, nome, possessor) VALUES
	('SAMA', 'Secretaria de Meio Ambiente', 'Prefeitura de Joinville'),
	('SEPUR', 'Secretaria de Pesquisa e Planejamento Urbano', 'Prefeitura de Joinville'),
	('IMA', 'Instituto do Meio Ambiente de Santa Catarina', null);

INSERT INTO public."Situacao" (codigo, descricao) VALUES 
	('AGU','Aguardando Resposta'),
	('AND','Em Andamento'),
	('CON','Concluído'),
	('DES','Descontinuado'),
	('NAO','Não Iniciado'),
	('RES','Respondido');

INSERT INTO public."Atividade" (codigo, nome) VALUES 
	('ANA_AMB', 'Análises Ambientais'),
	('APR_PRO', 'Aprovação de Projetos'),
	('CON_PEN', 'Condicionante Pendente'),
	('CON_SER', 'Contratos e Serviços'),
	('MAT_CON', 'Matriz de Condicionantes'),
	('MAT_LIC', 'Matriz de Licenciamento'),
	('OFI', 'Ofício'),
	('OKR', 'OKR'),
	('PAR_CON_AMB', 'Parecer de Conformidade Ambiental'),
	('REL_CON', 'Relatório de Condicionantes'),
	('VIS', 'Vistoria'),
	('DIV', 'Diversos');

INSERT INTO public."Localizacao" (codigo, nome) VALUES 
	('ALM', 'Almoxarifado'),
	('ATE_CEN', 'Atendimento Centro'),
	('BAU', 'Baurmgarten'),
	('BRI_MAG', 'Brinquedo Mágico'),
	('BUC', 'Bucarein'),
	('COL_ESG', 'Coleta de Esgoto'),
	('CUB', 'Cubatão'),
	('EDG_LEH', 'Edgar Lehm'),
	('ESP', 'Espinheiros'),
	('EST_ANA', 'Estrada Anaburgo'),
	('FEL', 'Felicitá'),
	('FLA', 'Flamboyant'),
	('GUA', 'Guaxanduva'),
	('IRI', 'Iririú'),
	('JAR_FLO', 'Jardim das Flores'),
	('JAR_IRI', 'Jardim Iririú'),
	('JAR_PAR', 'Jardim Paraíso'),
	('JAR_SOF', 'Jardim Sofia'),
	('JAR', 'Jarivatuba'),
	('MOR_AMA', 'Morro do Amaral'),
	('MOR_MEI', 'Morro do Meio'),
	('PAR', 'Paranaguamirim'),
	('PIB', 'Pirabeiraba'),
	('PIR', 'Piraí'),
	('PIR_SUL', 'Piraí Sul'),
	('POR_HOR', 'Portal do Horizonte'),
	('PRO', 'Profipo'),
	('REC', 'Reclimat'),
	('SED_ADM', 'Sede administrativa'),
	('VIG', 'Vigorelli'),
	('VIL_NOV', 'Vila Nova'),
	('PRO_PRI', 'Propriedades privadas'),
	('WAL_ROS', 'Waldomiro Rosa');

INSERT INTO public."Sublocalidade" (codigo, nome) VALUES
	('ADU','Adutora'),
	('COM','Complexo'),
	('EMI','Emissário'),
	('EXT_ELE','Extravasor EEE'),
	('ELE','EEE'),
	('ETA','ETA'),
	('ETE','ETE'),
	('RED','Rede'),
	('LAG','Lagoas'),
	('BAC_31','Bacia 3.1'),
	('BAC_32','Bacia 3.2'),
	('BAC_4','Bacia 4'),
	('BAC_5','Bacia 5'),
	('BAC_6','Bacia 6'),
	('BAC_7','Bacia 7'),
	('BAC_81','Bacia 8.1'),
	('BAC_82','Bacia 8.2'),
	('BAC_9','Bacia 9'),
	('BAC_9_3','Bacia 9 - Etapa 3'),
	('BAC_9_7','Bacia 9 - Etapa 7'),
	('BAC_10','Bacia 10'),
	('BAC_10_2','Bacia 10 - Etapa 2'),
	('BAC_11','Bacia 11'),
	('BAC_CEN','Bacia Centro'),
	('RES_0','R0'),
	('RES_1','R1'),
	('RES_2','R2'),
	('RES_3','R3'),
	('RES_4','R4'),
	('RES_5','R5'),
	('RES_6','R6'),
	('RES_7','R7'),
	('RES_8','R8'),
	('RES_9','R9'),
	('RES_10','R10'),
	('RES_11','R11'),
	('RES_12','R12'),
	('RES_X','RX');

INSERT INTO public."Obj_Res_Cha" (codigo, trimestre, ano) VALUES
	('1_2024', 1, '2024'),
	('2_2024', 2, '2024'),
	('3_2024', 3, '2024'),
	('4_2024', 4, '2024'),
	('1_2025', 1, '2025'),
	('2_2025', 2, '2025'),
	('3_2025', 3, '2025'),
	('4_2025', 4, '2025');

INSERT INTO public."Tipo" (codigo, nome) VALUES
	('ALV_CON','Alvará de Construção'),
	('ALV_TER','Alvará de Terraplanagem'),
	('AUT_COR','Autorização de Corte'),
	('ALV_DEM','Alvará de Demolição'),
	('OUT','Outorga'),
	('LAI','LAI'),
	('LAP','LAP'),
	('LAO','LAO'),
	('EIV','EIV'),
	('DAN','DANC'),
	('ETA','ETA'),
	('ETE','ETE'),
	('PI','PI'),
	('DES','Despesas'),
	('AAS_PRE','AAS Preliminar'),
	('SUP','Supervisão/Fiscalização'),
	('DIV','Diversos');