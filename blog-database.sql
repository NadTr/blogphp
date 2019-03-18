DROP TABLE IF EXISTS "users" cascade;
DROP TABLE IF EXISTS "articles" cascade;
DROP TABLE IF EXISTS "categories" cascade;
DROP TABLE IF EXISTS "categoriesarticles" cascade;
DROP TABLE IF EXISTS "comments" cascade;

CREATE TABLE "users" (
    "id" SERIAL PRIMARY KEY NOT NULL,
    "firstname" character varying(50) NOT NULL,
    "lastname" character varying(50) NOT NULL,
    "username" character varying(50) NOT NULL UNIQUE,
    "pass" text NOT NULL,
    "permission" smallint NOT NULL CHECK (0 < permission AND permission < 4), -- 1 Admin, 2 Author, 3 User lambda, other = not connected
    "email" VARCHAR (100) NOT NULL CHECK (email SIMILAR TO '(([a-zA-Z0-9_\-]+\.)?)+[a-zA-Z0-9_\-]+@([a-zA-Z0-9_\-]+\.[a-z]{2,4})') UNIQUE
);

CREATE TABLE "articles" (
    "id" SERIAL PRIMARY KEY NOT NULL,
    "title" character varying(250) NOT NULL,
    "text" text NOT NULL,
    "date" timestamp NOT NULL,
    "author" integer NOT NULL,
    FOREIGN KEY (author) REFERENCES users (id) on delete cascade
);

CREATE TABLE "categories" (
    "id" SERIAL PRIMARY KEY NOT NULL,
    "name" character varying(50) NOT NULL
);


CREATE TABLE "categoriesarticles" (
    "categorie" integer NOT NULL,
    "article" integer NOT NULL,
    FOREIGN KEY (categorie) REFERENCES categories (id) on delete cascade,
    FOREIGN KEY (article) REFERENCES articles (id) on delete cascade
);

CREATE TABLE "comments" (
    "id" SERIAL PRIMARY KEY NOT NULL,
    "date" timestamp NOT NULL,
    "text" text NOT NULL,
    "article" integer NOT NULL,
    "commentator" integer NOT NULL,
    FOREIGN KEY (article) REFERENCES articles (id) on delete cascade,
    FOREIGN KEY (commentator) REFERENCES users (id) on delete cascade
);

INSERT INTO "users" ( "firstname", "lastname", "username", "pass", "permission", "email") VALUES
('Admin',   'Admin',  'Admin',    '$2y$10$JxEvKR7gEj5o07kEBU9O7O4oPzVkFesUyT78EnB72OHp3XDJk9TeO',    1,  'zofzfoef@fpoefe.xy');

INSERT INTO "articles" ( "title", "text", "date", "author") VALUES
( 'Le Lorem ipsum',    'Généralement, on utilise un texte en faux latin (le texte ne veut rien dire, il a été modifié), le Lorem ipsum ou Lipsum, qui permet donc de faire office de texte d''attente. L''avantage de le mettre en latin est que l''opérateur sait au premier coup d''oeil que la page contenant ces lignes n''est pas valide, et surtout l''attention du client n''est pas dérangée par le contenu, il demeure concentré seulement sur l''aspect graphique.',  '2019-02-27 08:54:16.774074',   1),
( 'Le Lorem ipsum',    'Généralement, on utilise un texte en faux latin (le texte ne veut rien dire, il a été modifié), le Lorem ipsum ou Lipsum, qui permet donc de faire office de texte d''attente. L''avantage de le mettre en latin est que l''opérateur sait au premier coup d''oeil que la page contenant ces lignes n''est pas valide, et surtout l''attention du client n''est pas dérangée par le contenu, il demeure concentré seulement sur l''aspect graphique.',  '2019-02-27 08:54:16.774074',   1),
( 'Le Lorem ipsum',    'Généralement, on utilise un texte en faux latin (le texte ne veut rien dire, il a été modifié), le Lorem ipsum ou Lipsum, qui permet donc de faire office de texte d''attente. L''avantage de le mettre en latin est que l''opérateur sait au premier coup d''oeil que la page contenant ces lignes n''est pas valide, et surtout l''attention du client n''est pas dérangée par le contenu, il demeure concentré seulement sur l''aspect graphique.',  '2019-02-27 08:54:16.774074',   1),
( 'Le Lorem ipsum',    'Généralement, on utilise un texte en faux latin (le texte ne veut rien dire, il a été modifié), le Lorem ipsum ou Lipsum, qui permet donc de faire office de texte d''attente. L''avantage de le mettre en latin est que l''opérateur sait au premier coup d''oeil que la page contenant ces lignes n''est pas valide, et surtout l''attention du client n''est pas dérangée par le contenu, il demeure concentré seulement sur l''aspect graphique.',  '2019-02-27 08:54:16.774074',   1),
( 'Le Lorem ipsum',    'Généralement, on utilise un texte en faux latin (le texte ne veut rien dire, il a été modifié), le Lorem ipsum ou Lipsum, qui permet donc de faire office de texte d''attente. L''avantage de le mettre en latin est que l''opérateur sait au premier coup d''oeil que la page contenant ces lignes n''est pas valide, et surtout l''attention du client n''est pas dérangée par le contenu, il demeure concentré seulement sur l''aspect graphique.',  '2019-02-27 08:54:16.774074',   1);

INSERT INTO "categories" ( "name") VALUES
('Du blabla'),
('Du texte'),
('Superbe catégorie'),
('Belle catégorie');

INSERT INTO "categoriesarticles" ("categorie", "article") VALUES
(1, 3),
(2,1),
(3, 1),
(4, 2),
(2, 5),
(1, 4);

INSERT INTO "comments" ("date", "text", "article", "commentator") VALUES
('2019-02-27 09:06:45.553865',   'J''ai bien aimé votre texte.',  1,  1);
