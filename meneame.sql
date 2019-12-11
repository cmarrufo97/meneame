DROP TABLE IF EXISTS categorias CASCADE;

CREATE TABLE categorias
(
    id              bigserial PRIMARY KEY
  , denominacion    varchar(255) NOT NULL UNIQUE 
);

DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios
(
     id       bigserial    PRIMARY KEY
   , login    varchar(255) NOT NULL UNIQUE
   , password varchar(255) NOT NULL
   , email    varchar(255) NOT NULL
);

DROP TABLE IF EXISTS noticias CASCADE;

CREATE TABLE noticias
(
    id              bigserial PRIMARY KEY
  , titulo          varchar(255) NOT NULL
  , cuerpo          text
  , usuario_id      bigint NOT NULL REFERENCES usuarios(id)
                    ON DELETE NO ACTION ON UPDATE CASCADE
  , categoria_id    bigint NOT NULL REFERENCES categorias(id)
                    ON DELETE NO ACTION ON UPDATE CASCADE  
  , created_at      timestamp DEFAULT NOW()
);

INSERT INTO usuarios (login,password,email)
VALUES ('pepe',crypt('pepe', gen_salt('bf',12)),'pepe@pepe.com')
     , ('juan',crypt('juan',gen_salt('bf',12)),'juan@gmail.com'); 
         
INSERT INTO categorias (denominacion)
VALUES ('Deportes')
     , ('Ciencia')
     , ('Política')
     , ('Arte')
     , ('Cine')
     , ('Actualidad')
     , ('Cultura')
     , ('Ocio')
     , ('Tecnología');



INSERT INTO noticias (titulo,cuerpo,usuario_id,categoria_id,created_at)
VALUES ('Noticia 1','Lorem ipsum dolor sit amet consectetur adipiscing elit sollicitudin nam magnis, non ultrices integer fames class venenatis himenaeos dui fringilla, eget suscipit semper rhoncus donec vitae dis mus massa. Eleifend orci non mauris vestibulum netus molestie tellus vel, litora cum maecenas cursus penatibus viverra torquent neque, imperdiet vehicula tristique mus nullam ac bibendum. Mus mauris eleifend natoque eget urna auctor taciti, facilisis molestie porttitor ullamcorper cras magna, sapien semper quam ac senectus phasellus.',1,5,'2018-09-10 12:30:00')
     , ('Noticia 2','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Dui faucibus in ornare quam viverra orci sagittis. Eget arcu dictum varius duis at consectetur lorem. Phasellus egestas tellus rutrum tellus pellentesque eu tincidunt tortor. Cras sed felis eget velit. Suscipit tellus mauris a diam maecenas sed enim ut sem. At in tellus integer feugiat scelerisque varius morbi enim nunc. Pellentesque id nibh tortor id. Quis risus sed vulputate odio ut. Nunc sed augue lacus viverra vitae congue eu consequat ac. Pulvinar mattis nunc sed blandit libero volutpat sed cras ornare. In mollis nunc sed id semper risus in. Posuere lorem ipsum dolor sit amet consectetur adipiscing elit. Sagittis vitae et leo duis.',1,2,'2019-09-10 12:30:10')
     , ('Noticia 3','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Dui faucibus in ornare quam viverra orci sagittis. Eget arcu dictum varius duis at consectetur lorem. Phasellus egestas tellus rutrum tellus pellentesque eu tincidunt tortor. Cras sed felis eget velit. Suscipit tellus mauris a diam maecenas sed enim ut sem. At in tellus integer feugiat scelerisque varius morbi enim nunc. Pellentesque id nibh tortor id. Quis risus sed vulputate odio ut. Nunc sed augue lacus viverra vitae congue eu consequat ac. Pulvinar mattis nunc sed blandit libero volutpat sed cras ornare. In mollis nunc sed id semper risus in. Posuere lorem ipsum dolor sit amet consectetur adipiscing elit. Sagittis vitae et leo duis.',1,1,'2016-06-15 15:30:56')
     , ('Noticia 4','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Dui faucibus in ornare quam viverra orci sagittis. Eget arcu dictum varius duis at consectetur lorem. Phasellus egestas tellus rutrum tellus pellentesque eu tincidunt tortor. Cras sed felis eget velit. Suscipit tellus mauris a diam maecenas sed enim ut sem. At in tellus integer feugiat scelerisque varius morbi enim nunc. Pellentesque id nibh tortor id. Quis risus sed vulputate odio ut. Nunc sed augue lacus viverra vitae congue eu consequat ac. Pulvinar mattis nunc sed blandit libero volutpat sed cras ornare. In mollis nunc sed id semper risus in. Posuere lorem ipsum dolor sit amet consectetur adipiscing elit. Sagittis vitae et leo duis.',1,3,'2014-09-10 01:30:24')
     , ('Noticia 5','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Dui faucibus in ornare quam viverra orci sagittis. Eget arcu dictum varius duis at consectetur lorem. Phasellus egestas tellus rutrum tellus pellentesque eu tincidunt tortor. Cras sed felis eget velit. Suscipit tellus mauris a diam maecenas sed enim ut sem. At in tellus integer feugiat scelerisque varius morbi enim nunc. Pellentesque id nibh tortor id. Quis risus sed vulputate odio ut. Nunc sed augue lacus viverra vitae congue eu consequat ac. Pulvinar mattis nunc sed blandit libero volutpat sed cras ornare. In mollis nunc sed id semper risus in. Posuere lorem ipsum dolor sit amet consectetur adipiscing elit. Sagittis vitae et leo duis.',2,5,'2018-09-10 16:00:01')
     , ('Noticia 6','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Dui faucibus in ornare quam viverra orci sagittis. Eget arcu dictum varius duis at consectetur lorem. Phasellus egestas tellus rutrum tellus pellentesque eu tincidunt tortor. Cras sed felis eget velit. Suscipit tellus mauris a diam maecenas sed enim ut sem. At in tellus integer feugiat scelerisque varius morbi enim nunc. Pellentesque id nibh tortor id. Quis risus sed vulputate odio ut. Nunc sed augue lacus viverra vitae congue eu consequat ac. Pulvinar mattis nunc sed blandit libero volutpat sed cras ornare. In mollis nunc sed id semper risus in. Posuere lorem ipsum dolor sit amet consectetur adipiscing elit. Sagittis vitae et leo duis.',2,5,'2019-12-25 18:30:15')
     , ('Noticia 7','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Dui faucibus in ornare quam viverra orci sagittis. Eget arcu dictum varius duis at consectetur lorem. Phasellus egestas tellus rutrum tellus pellentesque eu tincidunt tortor. Cras sed felis eget velit. Suscipit tellus mauris a diam maecenas sed enim ut sem. At in tellus integer feugiat scelerisque varius morbi enim nunc. Pellentesque id nibh tortor id. Quis risus sed vulputate odio ut. Nunc sed augue lacus viverra vitae congue eu consequat ac. Pulvinar mattis nunc sed blandit libero volutpat sed cras ornare. In mollis nunc sed id semper risus in. Posuere lorem ipsum dolor sit amet consectetur adipiscing elit. Sagittis vitae et leo duis.',2,4,'2017-01-5 07:22:00')
     , ('Noticia 8','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Dui faucibus in ornare quam viverra orci sagittis. Eget arcu dictum varius duis at consectetur lorem. Phasellus egestas tellus rutrum tellus pellentesque eu tincidunt tortor. Cras sed felis eget velit. Suscipit tellus mauris a diam maecenas sed enim ut sem. At in tellus integer feugiat scelerisque varius morbi enim nunc. Pellentesque id nibh tortor id. Quis risus sed vulputate odio ut. Nunc sed augue lacus viverra vitae congue eu consequat ac. Pulvinar mattis nunc sed blandit libero volutpat sed cras ornare. In mollis nunc sed id semper risus in. Posuere lorem ipsum dolor sit amet consectetur adipiscing elit. Sagittis vitae et leo duis.',2,2,'2019-05-20 10:12:20');
     