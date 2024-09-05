<?php

try {

  $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $checkTableSql = "SELECT EXISTS (
        SELECT FROM information_schema.tables 
        WHERE table_name = 'controle_demandas'
    )";
  $stmt = $pdo->query($checkTableSql);
  $tableExists = $stmt->fetchColumn();

  if (!$tableExists) {
    $createTableSql = "CREATE TABLE if not exists Controle_Demandas (
    id SERIAL PRIMARY KEY,    
    detalhamento VARCHAR(510),
    observacoes VARCHAR(510),
    data_recebido DATE,
    data_inicio DATE,
    data_final DATE,
    previsao_inicio DATE,
    previsao_entrega DATE,
    setor_responder VARCHAR(255),
    prazo_entrega_resposta DATE,
    data_respondido DATE,
    sei_numero TEXT,
    numero_documento TEXT,
    delta_t_inicio INTEGER,
    delta_t_final INTEGER,
    delta_t_atraso INTEGER,
    delta_t_prazo INTEGER,
	
    area INT,  
    prioridade INT,  
    responsavel INT,
      demanda INT,
    sistema INT,
      sub_sistema INT,
      tipo INT,
      situacao INT,

    FOREIGN KEY (area) REFERENCES Area(id),
      FOREIGN KEY (prioridade) REFERENCES Prioridade(id),
      FOREIGN KEY (responsavel) REFERENCES Responsavel(id),
      FOREIGN KEY (demanda) REFERENCES Demanda(id),
      FOREIGN KEY (sistema) REFERENCES Sistema(id),
      FOREIGN KEY (sub_sistema) REFERENCES Sub_Sistema(id),
      FOREIGN KEY (tipo) REFERENCES Tipo(id),
      FOREIGN KEY (situacao) REFERENCES Situacao(id)
    );";
    $pdo->exec($createTableSql);
    echo "Table 'Controle_Demandas' created successfully\n";
  } else {
    echo "Table 'Controle_Demandas' already exists\n";
  }
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}