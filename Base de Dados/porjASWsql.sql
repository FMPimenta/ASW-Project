DROP TABLE IF EXISTS mensagens;
DROP TABLE IF EXISTS chat_ligacao_utilizadores;
DROP TABLE IF EXISTS freguesia;
DROP TABLE IF EXISTS concelho;
DROP TABLE IF EXISTS distrito;
DROP TABLE IF EXISTS horario_acoes;
DROP TABLE IF EXISTS accao_ligacao_voluntario;
DROP TABLE IF EXISTS accao_voluntariado;
DROP TABLE IF EXISTS disponibilidade_ligacao_voluntario;
DROP TABLE IF EXISTS pop_alvo_ligacao_voluntario;
DROP TABLE IF EXISTS areas_ligacao_voluntario;
DROP TABLE IF EXISTS periodo_dia;
DROP TABLE IF EXISTS dia_semana;
DROP TABLE IF EXISTS populacao_alvo;
DROP TABLE IF EXISTS areas_interesse;
DROP TABLE IF EXISTS instituicao_registo;
DROP TABLE IF EXISTS voluntario_registo;

CREATE TABLE voluntario_registo (

    nome                VARCHAR(30)     NOT NULL,
    apelido             VARCHAR(30)     NOT NULL,
    data_nascimento     DATE            NOT NULL,
    genero              VARCHAR(10)     NOT NULL,
    concelho            VARCHAR(50)     NOT NULL,
    distrito            VARCHAR(20)     NOT NULL,
    freguesia           VARCHAR(60)     NOT NULL,
    telefone            NUMERIC(10)     NOT NULL,
    cc                  NUMERIC(7)      NOT NULL,
    carta               VARCHAR(1)      NOT NULL,
    mail                VARCHAR(320)    NOT NULL,
    pass                VARCHAR(60)     NOT NULL,
    foto                VARCHAR(200),
    
--
    CONSTRAINT pk_voluntario_registo_cc
        PRIMARY KEY (cc),
--
    CONSTRAINT un_voluntario_registo_mail     	 
        UNIQUE (mail)
);

CREATE TABLE instituicao_registo (
    nome                VARCHAR(20)     NOT NULL,
    descricao           VARCHAR(200)    NOT NULL,
    telefone            NUMERIC(9)      NOT NULL,
    morada              VARCHAR(50)     NOT NULL,
    distrito            VARCHAR(20)     NOT NULL,
    concelho            VARCHAR(30)     NOT NULL,
    freguesia           VARCHAR(30)     NOT NULL,
    mail                VARCHAR(320)    NOT NULL,
    website             VARCHAR(80),
    nome_representante  VARCHAR(20)     NOT NULL,
    mail_representante  VARCHAR(320)    NOT NULL,
    pass                VARCHAR(60)     NOT NULL,
--
    CONSTRAINT pk_instituicao_registo_telefone
        PRIMARY KEY (telefone)
);

CREATE TABLE areas_interesse (
    id_area     NUMERIC(2)      NOT NULL,
    nome        VARCHAR(200)    NOT NULL,
--
    CONSTRAINT pk_areas_interesse_voluntario_id_area
        PRIMARY KEY (id_area)     
);

CREATE TABLE populacao_alvo (
    id_pop_alvo     NUMERIC(2)  NOT NULL,
    nome_pop_alvo   VARCHAR(30) NOT NULL,
--
    CONSTRAINT pk_populacao_alvo_id_pop_alvo
        PRIMARY KEY (id_pop_alvo)  
);

CREATE TABLE dia_semana (
    id_dia     NUMERIC(1)  NOT NULL,
    nome_dia   VARCHAR(30) NOT NULL,
--
    CONSTRAINT pk_dia_semana_id_dia
        PRIMARY KEY (id_dia)  
);

CREATE TABLE periodo_dia (
    id_periodo     NUMERIC(1)  NOT NULL,
    nome_periodo   VARCHAR(30) NOT NULL,
--
    CONSTRAINT pk_periodo_dia_id_periodo
        PRIMARY KEY (id_periodo)  
);

CREATE TABLE areas_ligacao_voluntario (
    cc          NUMERIC(7)    NOT NULL,
    id_area     NUMERIC(2)    NOT NULL,
--
    CONSTRAINT pk_areas_ligacao_voluntario_cc_id_area
        PRIMARY KEY (cc,id_area), 
--
    CONSTRAINT fk_areas_ligacao_voluntario_cc
        FOREIGN KEY (cc) 
        REFERENCES voluntario_registo(cc),
--
    CONSTRAINT fk_areas_ligacao_voluntario_id_area
        FOREIGN KEY (id_area)
        REFERENCES areas_interesse(id_area)
);

CREATE TABLE pop_alvo_ligacao_voluntario (
    cc              NUMERIC(7)    NOT NULL,
    id_pop_alvo     NUMERIC(2)    NOT NULL,
--
    CONSTRAINT pk_pop_alvo_ligacao_voluntario_cc_id_pop_alvo
        PRIMARY KEY (cc, id_pop_alvo), 
--
    CONSTRAINT fk_pop_alvo_ligacao_voluntario_cc
        FOREIGN KEY (cc) 
        REFERENCES voluntario_registo(cc),
--
    CONSTRAINT fk_pop_alvo_ligacao_voluntario_id_pop_alvo
        FOREIGN KEY (id_pop_alvo)
        REFERENCES populacao_alvo(id_pop_alvo)
);

CREATE TABLE disponibilidade_ligacao_voluntario (
    cc              NUMERIC(7)     NOT NULL,
    dia             NUMERIC(1)     NOT NULL,
    periodo_dia     NUMERIC(1)     NOT NULL,
--
    CONSTRAINT pk_disponibilidade_ligacao_voluntario_cc_dia_periodo_dia
        PRIMARY KEY (cc, dia, periodo_dia), 
--
    CONSTRAINT fk_disponibilidade_cc
        FOREIGN KEY (cc)
        REFERENCES voluntario_registo(cc),
--
    CONSTRAINT fk_disponibilidade_dia
        FOREIGN KEY (dia)
        REFERENCES dia_semana(id_dia),
--
    CONSTRAINT fk_disponibilidade_periodo_dia
        FOREIGN KEY (periodo_dia)
        REFERENCES periodo_dia(id_periodo)

);

CREATE TABLE accao_voluntariado (
    id_accao     NUMERIC(4)      NOT NULL,
    nome_inst    VARCHAR(200)    NOT NULL,
    nome_acao    VARCHAR(200)    NOT NULL,
    distrito     VARCHAR(200)    NOT NULL,
    concelho     VARCHAR(200)    NOT NULL,
    freguesia    VARCHAR(200)    NOT NULL,
    funcao       VARCHAR(200)    NOT NULL,
    area         NUMERIC(2)      NOT NULL,
    populacao    NUMERIC(2)      NOT NULL,
    vagas        NUMERIC(10)     NOT NULL,
    

--
    CONSTRAINT pk_areas_interesse_voluntario_id_area
        PRIMARY KEY (id_accao),
--
    CONSTRAINT fk_accao_voluntariado_area
        FOREIGN KEY (area) 
        REFERENCES areas_interesse(id_area),
--
    CONSTRAINT fk_accao_voluntariado_populacao
        FOREIGN KEY (populacao) 
        REFERENCES populacao_alvo(id_pop_alvo)
  
);

CREATE TABLE accao_ligacao_voluntario (
    cc          NUMERIC(7)    NOT NULL, 
    id_accao    NUMERIC(4)    NOT NULL,
    aceite      VARCHAR(1)    NOT NULL,
    inst        NUMERIC(9)  NOT NULL,
--
    CONSTRAINT pk_accao_ligacao_voluntario_cc_id_accao
        PRIMARY KEY (cc,id_accao), 
--
    CONSTRAINT fk_accao_ligacao_voluntario_cc
        FOREIGN KEY (cc) 
        REFERENCES voluntario_registo(cc),
--
    CONSTRAINT fk_accao_ligacao_voluntario_id_accao
        FOREIGN KEY (id_accao)
        REFERENCES accao_voluntariado(id_accao),
--
    CONSTRAINT fk_accao_ligacao_voluntario_inst
        FOREIGN KEY (inst)
        REFERENCES instituicao_registo(telefone)
);

CREATE TABLE horario_acoes (
    id            NUMERIC(4)    NOT NULL,
    dia           NUMERIC(1)    NOT NULL,
    periodo       NUMERIC(1)    NOT NULL,

    CONSTRAINT fk_horario_acoes_id
        FOREIGN KEY (id) 
        REFERENCES accao_voluntariado(id_accao),

     CONSTRAINT fk_horario_acoes_dia
        FOREIGN KEY (dia) 
        REFERENCES dia_semana(id_dia),

     CONSTRAINT fk_periodo_dia_periodo
        FOREIGN KEY (periodo) 
        REFERENCES periodo_dia(id_periodo)

);

CREATE TABLE distrito (
    distrito      VARCHAR(100)    NOT NULL
);

CREATE TABLE concelho (
    concelho      VARCHAR(200)    NOT NULL
);

CREATE TABLE freguesia (
    freguesia      VARCHAR(200)    NOT NULL
);

CREATE TABLE chat_ligacao_utilizadores (
    chatid         NUMERIC(9)      NOT NULL,
    volid          NUMERIC(7),
    instid         NUMERIC(9),
--
    CONSTRAINT pk_chat_ligacao_utilizadores_chatid 
        PRIMARY KEY (chatid),
--
    CONSTRAINT fk_chat_ligacao_utilizadores_volid
        FOREIGN KEY (volid) 
        REFERENCES voluntario_registo(cc),
--
    CONSTRAINT fk_chat_ligacao_utilizadores_instid
        FOREIGN KEY (instid) 
        REFERENCES instituicao_registo(telefone)
);

CREATE TABLE mensagens (
    id_msg      NUMERIC(9)    NOT NULL,
    msg_de      NUMERIC(9)    NOT NULL,
    msg_para    NUMERIC(9)    NOT NULL,
    msg         VARCHAR(999)  NOT NULL,
    tempo       TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
--
    CONSTRAINT pk_mensagens_id_msg
        PRIMARY KEY (id_msg),
--
    CONSTRAINT fk_mensagens_msg_de
        FOREIGN KEY (msg_de) 
        REFERENCES chat_ligacao_utilizadores(chatid),
--
    CONSTRAINT fk_mensagens_msg_para
        FOREIGN KEY (msg_para) 
        REFERENCES chat_ligacao_utilizadores(chatid)
);


INSERT INTO areas_interesse VALUES(1, N'Artes e Entretenimento');
INSERT INTO areas_interesse VALUES(2, N'Atividade Política');
INSERT INTO areas_interesse VALUES(3, N'Ação Social');
INSERT INTO areas_interesse VALUES(4, N'Comunicação e Publicidade');
INSERT INTO areas_interesse VALUES(5, N'Educação');
INSERT INTO areas_interesse VALUES(6, N'Inovação e Tecnologias');
INSERT INTO areas_interesse VALUES(7, N'Meio Ambiente e Energias');
INSERT INTO areas_interesse VALUES(8, N'Moda e Beleza');
INSERT INTO areas_interesse VALUES(9, N'Saúde e Bem-estar');

INSERT INTO populacao_alvo VALUES(1, N'Crianças');
INSERT INTO populacao_alvo VALUES(2, N'Jovens');
INSERT INTO populacao_alvo VALUES(3, N'Adultos');
INSERT INTO populacao_alvo VALUES(4, N'Idosos');
INSERT INTO populacao_alvo VALUES(5, N'Família');

INSERT INTO dia_semana VALUES(1, N'Segunda-feira');
INSERT INTO dia_semana VALUES(2, N'Terça-feira');
INSERT INTO dia_semana VALUES(3, N'Quarta-feira');
INSERT INTO dia_semana VALUES(4, N'Quinta-feira');
INSERT INTO dia_semana VALUES(5, N'Sexta-feira');
INSERT INTO dia_semana VALUES(6, N'Sábado');
INSERT INTO dia_semana VALUES(7, N'Domingo');

INSERT INTO periodo_dia VALUES(1, N'Manhã');
INSERT INTO periodo_dia VALUES(2, N'Tarde');
INSERT INTO periodo_dia VALUES(3, N'Noite');


INSERT INTO distrito VALUES('Aveiro');
INSERT INTO distrito VALUES('Beja');
INSERT INTO distrito VALUES('Braga');
INSERT INTO distrito VALUES('Bragança');
INSERT INTO distrito VALUES('Castelo Branco');
INSERT INTO distrito VALUES('Coimbra');
INSERT INTO distrito VALUES('Évora');
INSERT INTO distrito VALUES('Guarda');
INSERT INTO distrito VALUES('Leiria');
INSERT INTO distrito VALUES('Lisboa');
INSERT INTO distrito VALUES('Portalegre');
INSERT INTO distrito VALUES('Porto');
INSERT INTO distrito VALUES('Santarém');
INSERT INTO distrito VALUES('Setúbal');
INSERT INTO distrito VALUES('Viana do Castelo');
INSERT INTO distrito VALUES('Vila Real');
INSERT INTO distrito VALUES('Viseu');

INSERT INTO concelho VALUES("Abrantes");
INSERT INTO concelho VALUES('Águeda');
INSERT INTO concelho VALUES("Aguiar da Beira");
INSERT INTO concelho VALUES("Alandroal");
INSERT INTO concelho VALUES("Albergaria-a-Velha");
INSERT INTO concelho VALUES("Albufeira");
INSERT INTO concelho VALUES("Alcácer do Sal");
INSERT INTO concelho VALUES("Alcanena");
INSERT INTO concelho VALUES("Alcobaça");
INSERT INTO concelho VALUES("Alcochete");
INSERT INTO concelho VALUES("Alcoutim");
INSERT INTO concelho VALUES("Alenquer");
INSERT INTO concelho VALUES("Alfândega da Fé");
INSERT INTO concelho VALUES("Alijó");
INSERT INTO concelho VALUES("Aljezur");
INSERT INTO concelho VALUES("Aljustrel");
INSERT INTO concelho VALUES("Almada");
INSERT INTO concelho VALUES("Almeida");
INSERT INTO concelho VALUES("Almeirim");
INSERT INTO concelho VALUES("Almodôvar");
INSERT INTO concelho VALUES("Alpiarça");
INSERT INTO concelho VALUES("Alter do Chão");
INSERT INTO concelho VALUES("Alvaiázere");
INSERT INTO concelho VALUES("Alvito");
INSERT INTO concelho VALUES("Amadora");
INSERT INTO concelho VALUES("Amarante");
INSERT INTO concelho VALUES("Amares");
INSERT INTO concelho VALUES("Anadia");
INSERT INTO concelho VALUES("Angra do Heroísmo");
INSERT INTO concelho VALUES("Ansião");
INSERT INTO concelho VALUES("Arcos de Valdevez");
INSERT INTO concelho VALUES("Arganil");
INSERT INTO concelho VALUES("Armamar");
INSERT INTO concelho VALUES("Arouca");
INSERT INTO concelho VALUES("Arraiolos");
INSERT INTO concelho VALUES("Arronches");
INSERT INTO concelho VALUES("Arruda dos Vinhos");
INSERT INTO concelho VALUES("Aveiro");
INSERT INTO concelho VALUES("Avis");
INSERT INTO concelho VALUES("Azambuja");
INSERT INTO concelho VALUES("Baião");
INSERT INTO concelho VALUES("Barcelos");
INSERT INTO concelho VALUES("Barrancos");
INSERT INTO concelho VALUES("Barreiro");
INSERT INTO concelho VALUES("Batalha");
INSERT INTO concelho VALUES("Beja");
INSERT INTO concelho VALUES("Belmonte");
INSERT INTO concelho VALUES("Benavente");
INSERT INTO concelho VALUES("Bombarral");
INSERT INTO concelho VALUES("Borba");
INSERT INTO concelho VALUES("Boticas");
INSERT INTO concelho VALUES("Braga");
INSERT INTO concelho VALUES("Bragança");
INSERT INTO concelho VALUES("Cabeceiras de Basto");
INSERT INTO concelho VALUES("Cadaval");
INSERT INTO concelho VALUES("Caldas da Rainha");
INSERT INTO concelho VALUES("Calheta (Madeira)");
INSERT INTO concelho VALUES("Calheta (São Jorge)");
INSERT INTO concelho VALUES("Caminha");
INSERT INTO concelho VALUES("Campo Maior");
INSERT INTO concelho VALUES("Cantanhede");
INSERT INTO concelho VALUES("Carrazeda de Ansiães");
INSERT INTO concelho VALUES("Carregal do Sal");
INSERT INTO concelho VALUES("Cartaxo");
INSERT INTO concelho VALUES("Cascais");
INSERT INTO concelho VALUES("Castanheira de Pêra");
INSERT INTO concelho VALUES("Castelo Branco");
INSERT INTO concelho VALUES("Castelo de Paiva");
INSERT INTO concelho VALUES("Castelo de Vide");
INSERT INTO concelho VALUES("Castro Daire");
INSERT INTO concelho VALUES("Castro Marim");
INSERT INTO concelho VALUES("Castro Verde");
INSERT INTO concelho VALUES("Celorico da Beira");
INSERT INTO concelho VALUES("Celorico de Basto");
INSERT INTO concelho VALUES("Chamusca");
INSERT INTO concelho VALUES("Chaves");
INSERT INTO concelho VALUES("Cinfães");
INSERT INTO concelho VALUES("Coimbra");
INSERT INTO concelho VALUES("Condeixa-a-Nova");
INSERT INTO concelho VALUES("Constância");
INSERT INTO concelho VALUES("Coruche");
INSERT INTO concelho VALUES("Corvo");
INSERT INTO concelho VALUES("Covilhã");
INSERT INTO concelho VALUES("Crato");
INSERT INTO concelho VALUES("Cuba");
INSERT INTO concelho VALUES("Câmara de Lobos");
INSERT INTO concelho VALUES("Elvas");
INSERT INTO concelho VALUES("Entroncamento");
INSERT INTO concelho VALUES("Espinho");
INSERT INTO concelho VALUES("Esposende");
INSERT INTO concelho VALUES("Estarreja");
INSERT INTO concelho VALUES("Estremoz");
INSERT INTO concelho VALUES("Évora");
INSERT INTO concelho VALUES("Fafe");
INSERT INTO concelho VALUES("Faro");
INSERT INTO concelho VALUES("Felgueiras");
INSERT INTO concelho VALUES("Ferreira do Alentejo");
INSERT INTO concelho VALUES("Ferreira do Zêzere");
INSERT INTO concelho VALUES("Figueira da Foz");
INSERT INTO concelho VALUES("Figueira de Castelo Rodrigo");
INSERT INTO concelho VALUES("Figueiró dos Vinhos");
INSERT INTO concelho VALUES("Fornos de Algodres");
INSERT INTO concelho VALUES("Freixo de Espada à Cinta");
INSERT INTO concelho VALUES("Fronteira");
INSERT INTO concelho VALUES("Funchal");
INSERT INTO concelho VALUES("Fundão");
INSERT INTO concelho VALUES("Gavião");
INSERT INTO concelho VALUES("Golegã");
INSERT INTO concelho VALUES("Gondomar");
INSERT INTO concelho VALUES("Gouveia");
INSERT INTO concelho VALUES("Grândola");
INSERT INTO concelho VALUES("Guarda");
INSERT INTO concelho VALUES("Guimarães");
INSERT INTO concelho VALUES("Góis");
INSERT INTO concelho VALUES("Horta");
INSERT INTO concelho VALUES("Idanha-a-Nova");
INSERT INTO concelho VALUES("Ílhavo");
INSERT INTO concelho VALUES("Lagoa (Algarve)");
INSERT INTO concelho VALUES("Lagoa (São Miguel)");
INSERT INTO concelho VALUES("Lagos");
INSERT INTO concelho VALUES("Lajes das Flores");
INSERT INTO concelho VALUES("Lajes do Pico");
INSERT INTO concelho VALUES("Lamego");
INSERT INTO concelho VALUES("Leiria");
INSERT INTO concelho VALUES("Lisboa");
INSERT INTO concelho VALUES("Loulé");
INSERT INTO concelho VALUES("Loures");
INSERT INTO concelho VALUES("Lourinhã");
INSERT INTO concelho VALUES("Lousã");
INSERT INTO concelho VALUES("Lousada");
INSERT INTO concelho VALUES("Mação");
INSERT INTO concelho VALUES("Macedo de Cavaleiros");
INSERT INTO concelho VALUES("Machico");
INSERT INTO concelho VALUES("Madalena");
INSERT INTO concelho VALUES("Mafra");
INSERT INTO concelho VALUES("Maia");
INSERT INTO concelho VALUES("Mangualde");
INSERT INTO concelho VALUES("Manteigas");
INSERT INTO concelho VALUES("Marco de Canaveses");
INSERT INTO concelho VALUES("Marinha Grande");
INSERT INTO concelho VALUES("Marvão");
INSERT INTO concelho VALUES("Matosinhos");
INSERT INTO concelho VALUES("Mealhada");
INSERT INTO concelho VALUES("Meda");
INSERT INTO concelho VALUES("Melgaço");
INSERT INTO concelho VALUES("Mesão Frio");
INSERT INTO concelho VALUES("Mira");
INSERT INTO concelho VALUES("Miranda do Corvo");
INSERT INTO concelho VALUES("Miranda do Douro");
INSERT INTO concelho VALUES("Mirandela");
INSERT INTO concelho VALUES("Mogadouro");
INSERT INTO concelho VALUES("Moimenta da Beira");
INSERT INTO concelho VALUES("Moita");
INSERT INTO concelho VALUES("Monção");
INSERT INTO concelho VALUES("Monchique");
INSERT INTO concelho VALUES("Mondim de Basto");
INSERT INTO concelho VALUES("Monforte");
INSERT INTO concelho VALUES("Montalegre");
INSERT INTO concelho VALUES("Montemor-o-Novo");
INSERT INTO concelho VALUES("Montemor-o-Velho");
INSERT INTO concelho VALUES("Montijo");
INSERT INTO concelho VALUES("Mora");
INSERT INTO concelho VALUES("Mortágua");
INSERT INTO concelho VALUES("Moura");
INSERT INTO concelho VALUES("Mourão");
INSERT INTO concelho VALUES("Murça");
INSERT INTO concelho VALUES("Murtosa");
INSERT INTO concelho VALUES("Mértola");
INSERT INTO concelho VALUES("Nazaré");
INSERT INTO concelho VALUES("Nelas");
INSERT INTO concelho VALUES("Nisa");
INSERT INTO concelho VALUES("Nordeste");
INSERT INTO concelho VALUES("Óbidos");
INSERT INTO concelho VALUES("Odemira");
INSERT INTO concelho VALUES("Odivelas");
INSERT INTO concelho VALUES("Oeiras");
INSERT INTO concelho VALUES("Oleiros");
INSERT INTO concelho VALUES("Olhão");
INSERT INTO concelho VALUES("Oliveira de Azeméis");
INSERT INTO concelho VALUES("Oliveira de Frades");
INSERT INTO concelho VALUES("Oliveira do Bairro");
INSERT INTO concelho VALUES("Oliveira do Hospital");
INSERT INTO concelho VALUES("Ourique");
INSERT INTO concelho VALUES("Ourém");
INSERT INTO concelho VALUES("Ovar");
INSERT INTO concelho VALUES("Paços de Ferreira");
INSERT INTO concelho VALUES("Palmela");
INSERT INTO concelho VALUES("Pampilhosa da Serra");
INSERT INTO concelho VALUES("Paredes");
INSERT INTO concelho VALUES("Paredes de Coura");
INSERT INTO concelho VALUES("Pedrógão Grande");
INSERT INTO concelho VALUES("Penacova");
INSERT INTO concelho VALUES("Penafiel");
INSERT INTO concelho VALUES("Penalva do Castelo");
INSERT INTO concelho VALUES("Penamacor");
INSERT INTO concelho VALUES("Penedono");
INSERT INTO concelho VALUES("Penela");
INSERT INTO concelho VALUES("Peniche");
INSERT INTO concelho VALUES("Peso da Régua");
INSERT INTO concelho VALUES("Pinhel");
INSERT INTO concelho VALUES("Pombal");
INSERT INTO concelho VALUES("Ponta Delgada");
INSERT INTO concelho VALUES("Ponta do Sol");
INSERT INTO concelho VALUES("Ponte da Barca");
INSERT INTO concelho VALUES("Ponte de Lima");
INSERT INTO concelho VALUES("Ponte de Sor");
INSERT INTO concelho VALUES("Portalegre");
INSERT INTO concelho VALUES("Portel");
INSERT INTO concelho VALUES("Portimão");
INSERT INTO concelho VALUES("Porto");
INSERT INTO concelho VALUES("Porto Moniz");
INSERT INTO concelho VALUES("Porto Santo");
INSERT INTO concelho VALUES("Porto de Mós");
INSERT INTO concelho VALUES("Povoação");
INSERT INTO concelho VALUES("Praia da Vitória");
INSERT INTO concelho VALUES("Proença-a-Nova");
INSERT INTO concelho VALUES("Póvoa de Lanhoso");
INSERT INTO concelho VALUES("Póvoa de Varzim");
INSERT INTO concelho VALUES("Redondo");
INSERT INTO concelho VALUES("Reguengos de Monsaraz");
INSERT INTO concelho VALUES("Resende");
INSERT INTO concelho VALUES("Ribeira Brava");
INSERT INTO concelho VALUES("Ribeira Grande");
INSERT INTO concelho VALUES("Ribeira de Pena");
INSERT INTO concelho VALUES("Rio Maior");
INSERT INTO concelho VALUES("Sabrosa");
INSERT INTO concelho VALUES("Sabugal");
INSERT INTO concelho VALUES("Salvaterra de Magos");
INSERT INTO concelho VALUES("Santa Comba Dão");
INSERT INTO concelho VALUES("Santa Cruz");
INSERT INTO concelho VALUES("Santa Cruz da Graciosa");
INSERT INTO concelho VALUES("Santa Cruz das Flores");
INSERT INTO concelho VALUES("Santa Maria da Feira");
INSERT INTO concelho VALUES("Santa Marta de Penaguião");
INSERT INTO concelho VALUES("Santana");
INSERT INTO concelho VALUES("Santarém");
INSERT INTO concelho VALUES("Santiago do Cacém");
INSERT INTO concelho VALUES("Santo Tirso");
INSERT INTO concelho VALUES("São Brás de Alportel");
INSERT INTO concelho VALUES("São João da Madeira");
INSERT INTO concelho VALUES("São João da Pesqueira");
INSERT INTO concelho VALUES("São Pedro do Sul");
INSERT INTO concelho VALUES("São Roque do Pico");
INSERT INTO concelho VALUES("São Vicente");
INSERT INTO concelho VALUES("Sardoal");
INSERT INTO concelho VALUES("Sátão");
INSERT INTO concelho VALUES("Seia");
INSERT INTO concelho VALUES("Seixal");
INSERT INTO concelho VALUES("Sernancelhe");
INSERT INTO concelho VALUES("Serpa");
INSERT INTO concelho VALUES("Sertã");
INSERT INTO concelho VALUES("Sesimbra");
INSERT INTO concelho VALUES("Setúbal");
INSERT INTO concelho VALUES("Sever do Vouga");
INSERT INTO concelho VALUES("Silves");
INSERT INTO concelho VALUES("Sines");
INSERT INTO concelho VALUES("Sintra");
INSERT INTO concelho VALUES("Sobral de Monte Agraço");
INSERT INTO concelho VALUES("Soure");
INSERT INTO concelho VALUES("Sousel");
INSERT INTO concelho VALUES("Tábua");
INSERT INTO concelho VALUES("Tabuaço");
INSERT INTO concelho VALUES("Tarouca");
INSERT INTO concelho VALUES("Tavira");
INSERT INTO concelho VALUES("Terras de Bouro");
INSERT INTO concelho VALUES("Tomar");
INSERT INTO concelho VALUES("Tondela");
INSERT INTO concelho VALUES("Torre de Moncorvo");
INSERT INTO concelho VALUES("Torres Novas");
INSERT INTO concelho VALUES("Torres Vedras");
INSERT INTO concelho VALUES("Trancoso");
INSERT INTO concelho VALUES("Trofa");
INSERT INTO concelho VALUES("Vagos");
INSERT INTO concelho VALUES("Vale de Cambra");
INSERT INTO concelho VALUES("Valença");
INSERT INTO concelho VALUES("Valongo");
INSERT INTO concelho VALUES("Valpaços");
INSERT INTO concelho VALUES("Velas");
INSERT INTO concelho VALUES("Vendas Novas");
INSERT INTO concelho VALUES("Viana do Alentejo");
INSERT INTO concelho VALUES("Viana do Castelo");
INSERT INTO concelho VALUES("Vidigueira");
INSERT INTO concelho VALUES("Vieira do Minho");
INSERT INTO concelho VALUES("Vila Flor");
INSERT INTO concelho VALUES("Vila Franca de Xira");
INSERT INTO concelho VALUES("Vila Franca do Campo");
INSERT INTO concelho VALUES("Vila Nova da Barquinha");
INSERT INTO concelho VALUES("Vila Nova de Cerveira");
INSERT INTO concelho VALUES("Vila Nova de Famalicão");
INSERT INTO concelho VALUES("Vila Nova de Foz Côa");
INSERT INTO concelho VALUES("Vila Nova de Gaia");
INSERT INTO concelho VALUES("Vila Nova de Paiva");
INSERT INTO concelho VALUES("Vila Nova de Poiares");
INSERT INTO concelho VALUES("Vila Pouca de Aguiar");
INSERT INTO concelho VALUES("Vila Real");
INSERT INTO concelho VALUES("Vila Real de Santo António");
INSERT INTO concelho VALUES("Vila Velha de Ródão");
INSERT INTO concelho VALUES("Vila Verde");
INSERT INTO concelho VALUES("Vila Viçosa");
INSERT INTO concelho VALUES("Vila de Rei");
INSERT INTO concelho VALUES("Vila do Bispo");
INSERT INTO concelho VALUES("Vila do Conde");
INSERT INTO concelho VALUES("Vila do Porto");
INSERT INTO concelho VALUES("Vimioso");
INSERT INTO concelho VALUES("Vinhais");
INSERT INTO concelho VALUES("Viseu");
INSERT INTO concelho VALUES("Vizela");
INSERT INTO concelho VALUES("Vouzela");

INSERT INTO freguesia VALUES('Aguada de Cima');
INSERT INTO freguesia VALUES('Fermentelos');
INSERT INTO freguesia VALUES('Macinhata do Vouga');
INSERT INTO freguesia VALUES('Valongo do Vouga');
INSERT INTO freguesia VALUES('União das freguesias de Águeda e Borralha');
INSERT INTO freguesia VALUES('União das freguesias de Barrô e Aguada de Baixo');
INSERT INTO freguesia VALUES('União das freguesias de Belazaima do Chão, Castanheira do Vouga e Agadão');
INSERT INTO freguesia VALUES('União das freguesias de Recardães e Espinhel');
INSERT INTO freguesia VALUES('União das freguesias de Travassô e Óis da Ribeira');
INSERT INTO freguesia VALUES('União das freguesias de Trofa, Segadães e Lamas do Vouga');
INSERT INTO freguesia VALUES('União das freguesias do Préstimo e Macieira de Alcoba');
INSERT INTO freguesia VALUES('Alquerubim');
INSERT INTO freguesia VALUES('Angeja');
INSERT INTO freguesia VALUES('Branca');
INSERT INTO freguesia VALUES('Ribeira de Fráguas');
INSERT INTO freguesia VALUES('Albergaria-a-Velha e Valmaior');
INSERT INTO freguesia VALUES('São João de Loure e Frossos');
INSERT INTO freguesia VALUES('Avelãs de Caminho');
INSERT INTO freguesia VALUES('Avelãs de Cima');
INSERT INTO freguesia VALUES('Moita');
INSERT INTO freguesia VALUES('Sangalhos');
INSERT INTO freguesia VALUES('São Lourenço do Bairro');
INSERT INTO freguesia VALUES('Vila Nova de Monsarros');
INSERT INTO freguesia VALUES('Vilarinho do Bairro');
INSERT INTO freguesia VALUES('União das freguesias de Amoreira da Gândara, Paredes do Bairro e Ancas');
INSERT INTO freguesia VALUES('União das freguesias de Arcos e Mogofores');
INSERT INTO freguesia VALUES('União das freguesias de Tamengos, Aguim e Óis do Bairro');
INSERT INTO freguesia VALUES('Alvarenga');
INSERT INTO freguesia VALUES('Chave');
INSERT INTO freguesia VALUES('Escariz');
INSERT INTO freguesia VALUES('Fermedo');
INSERT INTO freguesia VALUES('Mansores');
INSERT INTO freguesia VALUES('Moldes');
INSERT INTO freguesia VALUES('Rossas');
INSERT INTO freguesia VALUES('Santa Eulália');
INSERT INTO freguesia VALUES('São Miguel do Mato');
INSERT INTO freguesia VALUES('Tropeço');
INSERT INTO freguesia VALUES('Urrô');
INSERT INTO freguesia VALUES('Várzea');
INSERT INTO freguesia VALUES('União das freguesias de Arouca e Burgo');
INSERT INTO freguesia VALUES('União das freguesias de Cabreiros e Albergaria da Serra');
INSERT INTO freguesia VALUES('União das freguesias de Canelas e Espiunca');
INSERT INTO freguesia VALUES('União das freguesias de Covelo de Paivó e Janarde');
INSERT INTO freguesia VALUES('Aradas');
INSERT INTO freguesia VALUES('Cacia');
INSERT INTO freguesia VALUES('Esgueira');
INSERT INTO freguesia VALUES('Oliveirinha');
INSERT INTO freguesia VALUES('São Bernardo');
INSERT INTO freguesia VALUES('São Jacinto');
INSERT INTO freguesia VALUES('Santa Joana');
INSERT INTO freguesia VALUES('Eixo e Eirol');
INSERT INTO freguesia VALUES('Requeixo, Nossa Senhora de Fátima e Nariz');
INSERT INTO freguesia VALUES('União das freguesias de Glória e Vera Cruz');
INSERT INTO freguesia VALUES('Fornos');
INSERT INTO freguesia VALUES('Real');
INSERT INTO freguesia VALUES('Santa Maria de Sardoura');
INSERT INTO freguesia VALUES('São Martinho de Sardoura');
INSERT INTO freguesia VALUES('União das freguesias de Raiva, Pedorido e Paraíso');
INSERT INTO freguesia VALUES('União das freguesias de Sobrado e Bairros');
INSERT INTO freguesia VALUES('Espinho');
INSERT INTO freguesia VALUES('Paramos');
INSERT INTO freguesia VALUES('Silvalde');
INSERT INTO freguesia VALUES('União das freguesias de Anta e Guetim');
INSERT INTO freguesia VALUES('Avanca');
INSERT INTO freguesia VALUES('Pardilhó');
INSERT INTO freguesia VALUES('Salreu');
INSERT INTO freguesia VALUES('União das freguesias de Beduído e Veiros');
INSERT INTO freguesia VALUES('União das freguesias de Canelas e Fermelã');
INSERT INTO freguesia VALUES('Argoncilhe');
INSERT INTO freguesia VALUES('Arrifana');
INSERT INTO freguesia VALUES('Escapães');
INSERT INTO freguesia VALUES('Fiães');
INSERT INTO freguesia VALUES('Fornos');
INSERT INTO freguesia VALUES('Lourosa');
INSERT INTO freguesia VALUES('Milheirós de Poiares');
INSERT INTO freguesia VALUES('Mozelos');
INSERT INTO freguesia VALUES('Nogueira da Regedoura');
INSERT INTO freguesia VALUES('São Paio de Oleiros');
INSERT INTO freguesia VALUES('Paços de Brandão');
INSERT INTO freguesia VALUES('Rio Meão');
INSERT INTO freguesia VALUES('Romariz');
INSERT INTO freguesia VALUES('Sanguedo');
INSERT INTO freguesia VALUES('Santa Maria de Lamas');
INSERT INTO freguesia VALUES('São João de Ver');
INSERT INTO freguesia VALUES('União das freguesias de Caldas de São Jorge e Pigeiros');
INSERT INTO freguesia VALUES('União das freguesias de Canedo, Vale e Vila Maior');
INSERT INTO freguesia VALUES('União das freguesias de Lobão, Gião, Louredo e Guisande');
INSERT INTO freguesia VALUES('União das freguesias de Santa Maria da Feira, Travanca, Sanfins e Espargo');
INSERT INTO freguesia VALUES('União das freguesias de São Miguel do Souto e Mosteirô');
INSERT INTO freguesia VALUES('Gafanha da Encarnação');
INSERT INTO freguesia VALUES('Gafanha da Nazaré');
INSERT INTO freguesia VALUES('Gafanha do Carmo');
INSERT INTO freguesia VALUES('Ílhavo (São Salvador)');
INSERT INTO freguesia VALUES('Barcouço');
INSERT INTO freguesia VALUES('Casal Comba');
INSERT INTO freguesia VALUES('Luso');
INSERT INTO freguesia VALUES('Pampilhosa');
INSERT INTO freguesia VALUES('Vacariça');
INSERT INTO freguesia VALUES('União das freguesias da Mealhada, Ventosa do Bairro e Antes');
INSERT INTO freguesia VALUES('Bunheiro');
INSERT INTO freguesia VALUES('Monte');
INSERT INTO freguesia VALUES('Murtosa');
INSERT INTO freguesia VALUES('Torreira');
INSERT INTO freguesia VALUES('Carregosa');
INSERT INTO freguesia VALUES('Cesar');
INSERT INTO freguesia VALUES('Fajões');
INSERT INTO freguesia VALUES('Loureiro');
INSERT INTO freguesia VALUES('Macieira de Sarnes');
INSERT INTO freguesia VALUES('Ossela');
INSERT INTO freguesia VALUES('São Martinho da Gândara');
INSERT INTO freguesia VALUES('São Roque');
INSERT INTO freguesia VALUES('Vila de Cucujães');
INSERT INTO freguesia VALUES('União das freguesias de Nogueira do Cravo e Pindelo');
INSERT INTO freguesia VALUES('União das freguesias de Oliveira de Azeméis, Santiago de Riba-Ul, Ul, Macinhata da Seixa e Madail');
INSERT INTO freguesia VALUES('União das freguesias de Pinheiro da Bemposta, Travanca e Palmaz');
INSERT INTO freguesia VALUES('Oiã');
INSERT INTO freguesia VALUES('Oliveira do Bairro');
INSERT INTO freguesia VALUES('Palhaça');
INSERT INTO freguesia VALUES('União das freguesias de Bustos, Troviscal e Mamarrosa');
INSERT INTO freguesia VALUES('Cortegaça');
INSERT INTO freguesia VALUES('Esmoriz');
INSERT INTO freguesia VALUES('Maceda');
INSERT INTO freguesia VALUES('Válega');
INSERT INTO freguesia VALUES('União das freguesias de Ovar, São João, Arada e São Vicente de Pereira Jusã');
INSERT INTO freguesia VALUES('São João da Madeira');
INSERT INTO freguesia VALUES('Couto de Esteves');
INSERT INTO freguesia VALUES('Pessegueiro do Vouga');
INSERT INTO freguesia VALUES('Rocas do Vouga');
INSERT INTO freguesia VALUES('Sever do Vouga');
INSERT INTO freguesia VALUES('Talhadas');
INSERT INTO freguesia VALUES('União das freguesias de Cedrim e Paradela');
INSERT INTO freguesia VALUES('União das freguesias de Silva Escura e Dornelas');
INSERT INTO freguesia VALUES('Calvão');
INSERT INTO freguesia VALUES('Gafanha da Boa Hora');
INSERT INTO freguesia VALUES('Ouca');
INSERT INTO freguesia VALUES('Sosa');
INSERT INTO freguesia VALUES('Santo André de Vagos');
INSERT INTO freguesia VALUES('União das freguesias de Fonte de Angeão e Covão do Lobo');
INSERT INTO freguesia VALUES('União das freguesias de Ponte de Vagos e Santa Catarina');
INSERT INTO freguesia VALUES('União das freguesias de Vagos e Santo António');
INSERT INTO freguesia VALUES('Arões');
INSERT INTO freguesia VALUES('São Pedro de Castelões');
INSERT INTO freguesia VALUES('Cepelos');
INSERT INTO freguesia VALUES('Junqueira');
INSERT INTO freguesia VALUES('Macieira de Cambra');
INSERT INTO freguesia VALUES('Roge');
INSERT INTO freguesia VALUES('União das freguesias de Vila Chã, Codal e Vila Cova de Perrinho');
INSERT INTO freguesia VALUES('Ervidel');
INSERT INTO freguesia VALUES('Messejana');
INSERT INTO freguesia VALUES('São João de Negrilhos');
INSERT INTO freguesia VALUES('União das freguesias de Aljustrel e Rio de Moinhos');
INSERT INTO freguesia VALUES('Rosário');
INSERT INTO freguesia VALUES('Santa Cruz');
INSERT INTO freguesia VALUES('São Barnabé');
INSERT INTO freguesia VALUES('Aldeia dos Fernandes');
INSERT INTO freguesia VALUES('União das freguesias de Almodôvar e Graça dos Padrões');
INSERT INTO freguesia VALUES('União das freguesias de Santa Clara-a-Nova e Gomes Aires');
INSERT INTO freguesia VALUES('Alvito');
INSERT INTO freguesia VALUES('Vila Nova da Baronia');
INSERT INTO freguesia VALUES('Barrancos');
INSERT INTO freguesia VALUES('Baleizão');
INSERT INTO freguesia VALUES('Beringel');
INSERT INTO freguesia VALUES('Cabeça Gorda');
INSERT INTO freguesia VALUES('Nossa Senhora das Neves');
INSERT INTO freguesia VALUES('Santa Clara de Louredo');
INSERT INTO freguesia VALUES('São Matias');
INSERT INTO freguesia VALUES('União das freguesias de Albernoa e Trindade');
INSERT INTO freguesia VALUES('União das freguesias de Beja (Salvador e Santa Maria da Feira)');
INSERT INTO freguesia VALUES('União das freguesias de Beja (Santiago Maior e São João Baptista)');
INSERT INTO freguesia VALUES('União das freguesias de Salvada e Quintos');
INSERT INTO freguesia VALUES('União das freguesias de Santa Vitória e Mombeja');
INSERT INTO freguesia VALUES('União das freguesias de Trigaches e São Brissos');
INSERT INTO freguesia VALUES('Entradas');
INSERT INTO freguesia VALUES('Santa Bárbara de Padrões');
INSERT INTO freguesia VALUES('São Marcos da Ataboeira');
INSERT INTO freguesia VALUES('União das freguesias de Castro Verde e Casével');
INSERT INTO freguesia VALUES('Cuba');
INSERT INTO freguesia VALUES('Faro do Alentejo');
INSERT INTO freguesia VALUES('Vila Alva');
INSERT INTO freguesia VALUES('Vila Ruiva');
INSERT INTO freguesia VALUES('Figueira dos Cavaleiros');
INSERT INTO freguesia VALUES('Odivelas');
INSERT INTO freguesia VALUES('União das freguesias de Alfundão e Peroguarda');
INSERT INTO freguesia VALUES('União das freguesias de Ferreira do Alentejo e Canhestros');
INSERT INTO freguesia VALUES('Alcaria Ruiva');
INSERT INTO freguesia VALUES('Corte do Pinto');
INSERT INTO freguesia VALUES('Espírito Santo');
INSERT INTO freguesia VALUES('Mértola');
INSERT INTO freguesia VALUES('Santana de Cambas');
INSERT INTO freguesia VALUES('São João dos Caldeireiros');
INSERT INTO freguesia VALUES('União das freguesias de São Miguel do Pinheiro, São Pedro de Solis e São Sebastião dos Carros');
INSERT INTO freguesia VALUES('Amareleja');
INSERT INTO freguesia VALUES('Póvoa de São Miguel');
INSERT INTO freguesia VALUES('Sobral da Adiça');
INSERT INTO freguesia VALUES('União das freguesias de Moura (Santo Agostinho e São João Baptista) e Santo Amador');
INSERT INTO freguesia VALUES('União das freguesias de Safara e Santo Aleixo da Restauração');
INSERT INTO freguesia VALUES('Relíquias');
INSERT INTO freguesia VALUES('Sabóia');
INSERT INTO freguesia VALUES('São Luís');
INSERT INTO freguesia VALUES('São Martinho das Amoreiras');
INSERT INTO freguesia VALUES('Vila Nova de Milfontes');
INSERT INTO freguesia VALUES('Luzianes-Gare');
INSERT INTO freguesia VALUES('Boavista dos Pinheiros');
INSERT INTO freguesia VALUES('Longueira/Almograve');
INSERT INTO freguesia VALUES('Colos');
INSERT INTO freguesia VALUES('Santa Clara-a-Velha');
INSERT INTO freguesia VALUES('São Salvador e Santa Maria');
INSERT INTO freguesia VALUES('São Teotónio');
INSERT INTO freguesia VALUES('Vale de Santiago');
INSERT INTO freguesia VALUES('Ourique');
INSERT INTO freguesia VALUES('Santana da Serra');
INSERT INTO freguesia VALUES('União das freguesias de Garvão e Santa Luzia');
INSERT INTO freguesia VALUES('União das freguesias de Panoias e Conceição');
INSERT INTO freguesia VALUES('Brinches');
INSERT INTO freguesia VALUES('Pias');
INSERT INTO freguesia VALUES('Vila Verde de Ficalho');
INSERT INTO freguesia VALUES('União das freguesias de Serpa (Salvador e Santa Maria)');
INSERT INTO freguesia VALUES('União das freguesias de Vila Nova de São Bento e Vale de Vargo');
INSERT INTO freguesia VALUES('Pedrógão');
INSERT INTO freguesia VALUES('Selmes');
INSERT INTO freguesia VALUES('Vidigueira');
INSERT INTO freguesia VALUES('Vila de Frades');
INSERT INTO freguesia VALUES('Barreiros');
INSERT INTO freguesia VALUES('Bico');
INSERT INTO freguesia VALUES('Caires');
INSERT INTO freguesia VALUES('Carrazedo');
INSERT INTO freguesia VALUES('Dornelas');
INSERT INTO freguesia VALUES('Fiscal');
INSERT INTO freguesia VALUES('Goães');
INSERT INTO freguesia VALUES('Lago');
INSERT INTO freguesia VALUES('Rendufe');
INSERT INTO freguesia VALUES('Bouro (Santa Maria)');
INSERT INTO freguesia VALUES('Bouro (Santa Marta)');
INSERT INTO freguesia VALUES('União das freguesias de Amares e Figueiredo');
INSERT INTO freguesia VALUES('União das freguesias de Caldelas, Sequeiros e Paranhos');
INSERT INTO freguesia VALUES('União das freguesias de Ferreiros, Prozelo e Besteiros');
INSERT INTO freguesia VALUES('União das freguesias de Torre e Portela');
INSERT INTO freguesia VALUES('União das freguesias de Vilela, Seramil e Paredes Secas');
INSERT INTO freguesia VALUES('Abade de Neiva');
INSERT INTO freguesia VALUES('Aborim');
INSERT INTO freguesia VALUES('Adães');
INSERT INTO freguesia VALUES('Airó');
INSERT INTO freguesia VALUES('Aldreu');
INSERT INTO freguesia VALUES('Alvelos');
INSERT INTO freguesia VALUES('Arcozelo');
INSERT INTO freguesia VALUES('Areias');
INSERT INTO freguesia VALUES('Balugães');
INSERT INTO freguesia VALUES('Barcelinhos');
INSERT INTO freguesia VALUES('Barqueiros');
INSERT INTO freguesia VALUES('Cambeses');
INSERT INTO freguesia VALUES('Carapeços');
INSERT INTO freguesia VALUES('Carvalhal');
INSERT INTO freguesia VALUES('Carvalhas');
