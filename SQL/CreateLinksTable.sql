CREATE _____ IF NOT EXISTS _____
(
    id          _______(11) UNSIGNED ___ ____ AUTO_INCREMENT,
    title       _______(___)            DEFAULT "**MISSING TITLE**",
    description ____,
    url         VARCHAR(512) UNIQUE     DEFAULT "**MISSING WEB ADDRESS**",
    ____        ________(__) UNSIGNED   DEFAULT 0,
    created___  DATETIME                DEFAULT '____-__-__ __:__:__',
    ________at  DATETIME                _______ '____-__-__ __:__:__' ON ______ CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);