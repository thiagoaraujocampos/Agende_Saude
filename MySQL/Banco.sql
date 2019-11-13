CREATE DATABASE AgendeSaude;
DROP DATABASE AgendeSaude;
---------------------------------------------------------------------------------------
USE AgendeSaude;
---------------------------------------------------------------------------------------
CREATE TABLE Ubs(
CD_Ubs INT AUTO_INCREMENT,
NM_Ubs VARCHAR(30) NOT NULL,
NM_Endereco VARCHAR(50) NOT NULL,
NM_Bairro VARCHAR(30) NOT NULL,
NR_Residencia INT NOT NULL,
PRIMARY KEY (CD_Ubs)
);                                   
---------------------------------------------------------------------------------------
CREATE TABLE Funcionario(
NR_Cpf VARCHAR(14) UNIQUE NOT NULL,
CD_Nivel CHAR NOT NULL,
NM_Funcionario VARCHAR(50) NOT NULL,
NM_Senha VARCHAR(15) NOT NULL,
NM_TipoFuncionario VARCHAR(30) NOT NULL,
NM_Sexo VARCHAR(9) NOT NULL,
ID_Status TINYINT(1) NOT NULL,
ID_Ubs INT,
FOREIGN KEY (ID_Ubs) REFERENCES Ubs (CD_Ubs),
PRIMARY KEY (NR_Cpf)
);
---------------------------------------------------------------------------------------
CREATE TABLE Medico(
NR_Cpf VARCHAR(14) UNIQUE NOT NULL,
NR_Crm VARCHAR(15) NOT NULL,
NM_Medico VARCHAR(50) NOT NULL,
DS_Especialidade VARCHAR(50),
NM_Sexo VARCHAR(9) NOT NULL,
ID_Status TINYINT(1) NOT NULL,
ID_Ubs INT NOT NULL,
FOREIGN KEY (ID_Ubs) REFERENCES Ubs (CD_Ubs),
PRIMARY KEY (NR_Cpf)
);
---------------------------------------------------------------------------------------
CREATE TABLE Enfermeiro(
NR_Cpf VARCHAR(14) UNIQUE NOT NULL,
NR_Coren VARCHAR(15) NOT NULL,
NM_Enfermeiro VARCHAR(50) NOT NULL,
NM_Sexo VARCHAR(9) NOT NULL,
ID_Status TINYINT(1) NOT NULL,
ID_Ubs INT NOT NULL,
FOREIGN KEY (ID_Ubs) REFERENCES Ubs (CD_Ubs),
PRIMARY KEY (NR_Cpf)
);
---------------------------------------------------------------------------------------
CREATE TABLE Prontuario(
CD_Prontuario INT AUTO_INCREMENT,
NM_Endereco VARCHAR(50) NOT NULL,
NM_Bairro VARCHAR(30) NOT NULL,
NM_Complemento VARCHAR(20),
NR_Residencia INT NOT NULL,
NR_Fixo VARCHAR(14),
NR_Celular VARCHAR(15),
NM_Email VARCHAR(30),
NM_Senha VARCHAR(100) NOT NULL,
ID_Status TINYINT(1) NOT NULL,
ID_Ubs INT NOT NULL,
FOREIGN KEY (ID_Ubs) REFERENCES Ubs (CD_Ubs),
PRIMARY KEY (CD_Prontuario)
);
---------------------------------------------------------------------------------------
CREATE TABLE Paciente(
NR_Cpf VARCHAR(14) UNIQUE,
NR_Sus VARCHAR(18),
NM_Paciente VARCHAR(50) NOT NULL,
NM_Sexo VARCHAR(9) NOT NULL,
ID_Chefe TINYINT(1) NOT NULL,
ID_Status TINYINT(1) NOT NULL,
ID_Prontuario INT NOT NULL,
FOREIGN KEY (ID_Prontuario) REFERENCES Prontuario (CD_Prontuario),
PRIMARY KEY (NR_Cpf)
);
---------------------------------------------------------------------------------------
CREATE TABLE Consulta(
CD_Consulta INT AUTO_INCREMENT,
NM_Consulta VARCHAR(30) NOT NULL,
HR_ConsultaInicio VARCHAR(5) NOT NULL,
HR_ConsultaFinal VARCHAR(5) NOT NULL,
NM_DiasSemana VARCHAR(7) NOT NULL,
ID_Status TINYINT(1) NOT NULL,
ID_Funcionario VARCHAR(14) NOT NULL,
ID_Medico VARCHAR(14),
ID_Enfermeiro VARCHAR(14),
ID_Ubs INT NOT NULL,
FOREIGN KEY (ID_Funcionario) REFERENCES Funcionario (NR_Cpf),
FOREIGN KEY (ID_Medico) REFERENCES Medico (NR_Cpf),
FOREIGN KEY (ID_Enfermeiro) REFERENCES Enfermeiro (NR_Cpf),
FOREIGN KEY (ID_Ubs) REFERENCES Ubs (CD_Ubs),
PRIMARY KEY (CD_Consulta)
);
---------------------------------------------------------------------------------------
CREATE TABLE AgendamentoConsulta(
CD_AgendamentoConsulta INT AUTO_INCREMENT,
DT_AgendamentoConsulta VARCHAR(10) NOT NULL,
NM_Situacao VARCHAR(9) NOT NULL,
ID_Funcionario VARCHAR(14),
ID_Paciente VARCHAR(14) NOT NULL,
ID_Consulta INT NOT NULL,
FOREIGN KEY (ID_Funcionario) REFERENCES Funcionario (NR_Cpf),
FOREIGN KEY (ID_Paciente) REFERENCES Paciente (NR_Cpf),
FOREIGN KEY (ID_Consulta) REFERENCES Consulta (CD_Consulta),
PRIMARY KEY (CD_AgendamentoConsulta)
);
------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------
# Inserts
INSERT INTO Ubs VALUES
(NULL, 'Jardim Praia Grande', 'Av. Monteiro Lobato', 'Jardim Praia Grande', '6506');

------------------------------------------------------------------------------------------------------------------------------------
INSERT INTO Prontuario VALUES
(NULL, 'Rua Henedina Sekler Patrici', 'Jardim Praia Grande', NULL, '131', '(13) 3448-8987', '(13) 98194-6810', 'rebecapinheiro98@hotmail.com', 'senha123', '1','1');

------------------------------------------------------------------------------------------------------------------------------------
INSERT INTO Paciente VALUES
('475.383.358-54', '111 1111 1111 1111', 'Rebeca Shimada Pinheiro',          'Feminino'	, '1', '1', '1'),
('475.806.728-71', '222 2222 2222 2222', 'Thiago Araujo Campos',             'Masculino', '0', '1', '1'),
('475.382.758-51', '333 3333 3333 3333', 'Raquel Shimada Pinheiro',          'Feminino'	, '0', '1', '1'),
('475.046.408-24', '444 4444 4444 4444', 'Pamella da Silva Ferreira Xavier', 'Feminino'	, '0', '1', '1');

------------------------------------------------------------------------------------------------------------------------------------
INSERT INTO Prontuario VALUES
(NULL, 'Rua Ursolina de Lima', 'Jardim Praia Grande', NULL, '520', '(13) 3507-7029', '(13) 98833-0765', 'oswaldinhoboladao@gmail.com', 'senha123', '1','1');

------------------------------------------------------------------------------------------------------------------------------------
INSERT INTO Paciente VALUES
('254.545.528-54', '555 5555 5555 5555', 'Oswaldo Luiz Paquier Bertoli',   'Masculino'	, '1', '1', '2'),
('335.806.728-71', '666 6666 6666 6666', 'Graciete Henriques dos Santos',  'Feminino'	, '0', '1', '2'),
('175.383.548-61', '777 7777 7777 7777', 'Jussimar Nascimento Leal',       'Masculino'	, '0', '1', '2'),
('488.772.668-11', '888 8888 8888 8888', 'Felipe Lourenço',                'Masculino'	, '0', '1', '2'),
('888.121.658-86', '999 9999 9999 9999', 'Diogenes Leandro Leite Pereira', 'Masculino'	, '0', '1', '2'),
('565.748.888-22', '123 4567 8912 3456', 'Alessandro Wingerter da Silva',  'Masculino'	, '0', '1', '2');

------------------------------------------------------------------------------------------------------------------------------------
INSERT INTO Prontuario VALUES
(NULL, 'Rua Pedro Batista Teixeira', 'Jardim Praia Grande', NULL, '1866', NULL, '(13) 98215-9887', 'ingridneves2@gmail.com', 'senha123', '0', '1');

------------------------------------------------------------------------------------------------------------------------------------
INSERT INTO Paciente VALUES
('491.240.738-06', '234 5678 9123 4567', 'Ingrid Silva das Neves',          'Feminino', '1', '1', '3'),
('489.118.778-67', '345 6789 1234 5678', 'Karina Campi da Silva',           'Feminino', '0', '1', '3'),
('467.738.338-33', '456 7891 2345 6789', 'Júlia Mara e Silva',              'Feminino', '0', '1', '3'),
('449.907.448-70', '567 8912 3456 7891', 'Samara Felizardo Dias de Araujo', 'Feminino', '0', '1', '3');

------------------------------------------------------------------------------------------------------------------------------------
INSERT INTO Funcionario VALUES
('449.907.448-70', '0', 'Samara Felizardo Dias de Araujo', 'senha123', 'Recepcionista', 'Feminino', '1', '1'),
('489.118.778-67', '1', 'Karina Campi da Silva',           'senha123', 'Chefe',         'Feminino', '1', '1'),
('467.738.338-33', '2', 'Júlia Mara e Silva',              'senha123', 'Diretora',      'Feminino', '1', '1');

------------------------------------------------------------------------------------------------------------------------------------
INSERT INTO Medico VALUES 
('491.240.738-06', '9874563', 'Ingrid Silva das Neves', 'Cardiologista', 'Feminino', '1', '1');

------------------------------------------------------------------------------------------------------------------------------------
INSERT INTO Enfermeiro VALUES 
('497.724.438-99', '1938993', 'Nicolas Pimentel de Almeida', 'Masculino', '1', '1');
------------------------------------------------------------------------------------------------------------------------------------
INSERT INTO Consulta VALUES 
(NULL, 'Pediatria', '09:00', '12:00', '0001000', '1', '467.738.338-33', '491.240.738-06', null, '1');

------------------------------------------------------------------------------------------------------------------------------------
INSERT INTO Consulta VALUES 
(NULL, 'Clinico Geral', '08:30', '11:00', '0010100', '1', '467.738.338-33', '491.240.738-06', null, '1');

------------------------------------------------------------------------------------------------------------------------------------
INSERT INTO AgendamentoConsulta VALUES
(NULL, '08/12/2016', 'Realizada', '449.907.448-70', '888.121.658-86', '02'),
(NULL, '16/12/2016', 'Cancelada', '449.907.448-70', '565.748.888-22', '02');

INSERT INTO AgendamentoConsulta VALUES
(NULL, '08/10/2016', 'Realizada', '449.907.448-70', '888.121.658-86', '02'),
(NULL, '09/11/2016', 'Realizada', '449.907.448-70', '888.121.658-86', '02'),
(NULL, '30/11/2016', 'Realizada', '449.907.448-70', '888.121.658-86', '02'),
(NULL, '02/11/2016', 'Cancelada', '449.907.448-70', '565.748.888-22', '02');
------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------
# Selects
SELECT * FROM Paciente;
select * from Consulta;
SELECT * FROM AgendamentoConsulta;
select * from Prontuario;
SELECT * FROM Funcionario;
SELECT * FROM Enfermeiro;
SELECT * FROM Medico;

select NM_Email from Prontuario where CD_Prontuario = 3;

select NM_Paciente from Paciente, Prontuario
where ID_Chefe = 1 and ID_Prontuario = 2 and ID_Prontuario = CD_Prontuario;

select NM_Paciente from Paciente, Prontuario
where ID_Chefe = 0 and ID_Prontuario = 2 and ID_Prontuario = CD_Prontuario;

select NM_Funcionario from Funcionario
where CD_Nivel = 0;

select NM_Funcionario from Funcionario
where CD_Nivel = 1;

select NM_Medico from Medico;

select NM_Enfermeiro from Enfermeiro;

select NM_Paciente, NR_Cpf, NR_Sus, ID_Chefe, ID_Prontuario from Paciente, Prontuario
where ID_Prontuario = 1 and ID_Prontuario = CD_Prontuario;

select * from Prontuario;

Select NM_Consulta, NM_DiasSemana, HR_ConsultaInicio, HR_ConsultaFinal FROM Consulta WHERE ID_Ubs = 1;

select ID_Prontuario from Paciente, Prontuario
where NM_Paciente = 'Oswaldo Bertoli' and ID_Prontuario = CD_Prontuario;

SELECT ID_Prontuario FROM Paciente, Prontuario
where NR_Cpf = '475.382.758-51' and ID_Prontuario = CD_Prontuario;

SELECT NM_Ubs FROM Ubs, Prontuario WHERE CD_Prontuario = '2';

SELECT NM_Paciente, ID_Chefe FROM Paciente, Prontuario
WHERE ID_Prontuario = '1' 
AND ID_Prontuario = CD_Prontuario;

SELECT NM_Paciente, ID_Chefe FROM Paciente, Prontuario
WHERE ID_Prontuario = CD_Prontuario AND ID_Prontuario LIKE '1' 
ORDER BY ID_Chefe DESC, NM_Paciente ASC;

SELECT CD_Prontuario FROM Prontuario;

SELECT CD_AgendamentoConsulta FROM AgendamentoConsulta
WHERE DT_AgendamentoConsulta = '07/12/2016';

SELECT CD_AgendamentoConsulta, ID_Paciente, ID_Consulta, DT_AgendamentoConsulta, NM_Situacao FROM AgendamentoConsulta
WHERE ID_Paciente = '475.383.358-54' AND ID_Consulta = '01' AND DT_AgendamentoConsulta = '07/12/2016' AND NM_Situacao = 'Em Aberto';

SELECT CD_AgendamentoConsulta, ID_Paciente, ID_Consulta, DT_AgendamentoConsulta, NM_Situacao FROM AgendamentoConsulta
WHERE ID_Paciente = '565.748.888-22' AND ID_Consulta = '02' AND DT_AgendamentoConsulta = '16/12/2016' AND NM_Situacao = 'Cancelada';

SELECT NM_Paciente, NR_Cpf, ID_Prontuario FROM Paciente
WHERE NR_Cpf = '565.748.888-22';

SELECT NR_Cpf, NR_Sus, NM_Paciente, ID_Chefe, ID_Prontuario FROM Paciente, Prontuario WHERE ID_Prontuario = CD_Prontuario AND ID_Prontuario = '1' ORDER BY ID_Chefe DESC, NM_Paciente ASC;

SELECT CD_Prontuario, ID_Status FROM Prontuario WHERE CD_Prontuario = 3;

SELECT NM_Paciente, ID_Prontuario FROM Paciente WHERE NM_Paciente LIKE '%th%';

SELECT * FROM Consulta WHERE NM_Consulta = '%tes%';

SELECT NR_Cpf, NM_Medico FROM Medico;

SELECT * FROM AgendamentoConsulta WHERE DT_AgendamentoConsulta = '08/12/2016' ORDER BY NM_Situacao DESC, ID_Paciente ASC;

SELECT NM_Funcionario FROM Funcionario WHERE ID_Ubs = 1;

SELECT NR_Cpf FROM AgendamentoConsulta, Paciente WHERE ID_Prontuario = '1' AND ID_Paciente = NR_Cpf;

SELECT NM_Paciente, DT_AgendamentoConsulta, NM_Consulta, HR_ConsultaInicio, HR_ConsultaFinal FROM Paciente, Consulta, AgendamentoConsulta WHERE ID_Prontuario = 1;

UPDATE Consulta SET NM_Consulta = '', HR_ConsultaInicio = '', HR_ConsultaFinal = '', NM_DiasSemana = '', ID_Funcionario = '', ID_Medico = '', ID_Enfermeiro = '' WHERE CD_Consulta = ''; 

SELECT * FROM Paciente WHERE ID_Prontuario = '1';

SELECT * FROM AgendamentoConsulta WHERE ID_Paciente = '475.806.728-71';

SELECT * FROM AgendamentoConsulta WHERE ID_Paciente = '475.046.408-24';
 
UPDATE AgendamentoConsulta SET ID_Paciente = '000.000.000-00' WHERE ID_Paciente = '475.806.728-71';

UPDATE Paciente SET NM_Paciente = 'Thiago Araujo' WHERE NR_Cpf = '475.806.728-71';