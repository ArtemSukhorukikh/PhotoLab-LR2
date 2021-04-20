--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2
-- Dumped by pg_dump version 13.2

-- Started on 2021-04-20 22:48:43

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 203 (class 1259 OID 16420)
-- Name: photoLabPosts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."photoLabPosts" (
    "idPost" integer NOT NULL,
    description character varying NOT NULL,
    "datePublication" date NOT NULL,
    "middleRating" real,
    ratings integer[],
    "urlPhoto" character varying NOT NULL,
    "userEmail" character varying NOT NULL
);


ALTER TABLE public."photoLabPosts" OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 16430)
-- Name: photoLabPosts_idPost_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."photoLabPosts" ALTER COLUMN "idPost" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."photoLabPosts_idPost_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 202 (class 1259 OID 16412)
-- Name: photoLabUsers; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."photoLabUsers" (
    id integer NOT NULL,
    firstname character varying NOT NULL,
    secondname character varying NOT NULL,
    fathername character varying,
    email character varying NOT NULL,
    hashpassword character varying NOT NULL
);


ALTER TABLE public."photoLabUsers" OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 16428)
-- Name: photoLabUsers_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."photoLabUsers" ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."photoLabUsers_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 206 (class 1259 OID 16432)
-- Name: postsRatings; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."postsRatings" (
    "idRating" integer NOT NULL,
    "idPost" integer NOT NULL,
    "userEmail" character varying NOT NULL,
    "valueRating" integer NOT NULL
);


ALTER TABLE public."postsRatings" OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 16440)
-- Name: postsRating_idRating_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."postsRatings" ALTER COLUMN "idRating" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."postsRating_idRating_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 2835 (class 0 OID 16420)
-- Dependencies: 203
-- Data for Name: photoLabPosts; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."photoLabPosts" ("idPost", description, "datePublication", "middleRating", ratings, "urlPhoto", "userEmail") FROM stdin;
11	Тестовое описание 2	2021-04-15	5	{32}	../userPhotos/2.jpg	Des1337481@gmail.com
10	Тестовое описание	2021-04-12	5	{31}	../userPhotos/1.jpg	Des1337481@gmail.com
15	Пост 3	2021-04-20	5	{34}	../userPhotos/c43f2e062ac3dc14f09a5220b71eea81.jpeg	Des1337481@gmail.com
\.


--
-- TOC entry 2834 (class 0 OID 16412)
-- Dependencies: 202
-- Data for Name: photoLabUsers; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."photoLabUsers" (id, firstname, secondname, fathername, email, hashpassword) FROM stdin;
2	Artem	Sukhorukikh	Olegovich	Des1337481@gmail.com	$2y$10$NNd/.8hGQltsfnzpEfL9t.IpaOaWLAPAl./PhbCCuxwujCyqlzL5O
3	test	test	test	test1@test.ru	$2y$10$PS/b6idwW8tJrzdCVlInr.U8ovlIY./c5B6MgOPL5Q2EuI6Gr/zUq
6	Artem	Osipov	Aleksandrovich	arti_man1997@mail.ru	$2y$10$rmpcQPWE9gBKDMhJKlPiQO0nVMwftNDA5rNmg2/qlmNipDU1MVXxO
\.


--
-- TOC entry 2838 (class 0 OID 16432)
-- Dependencies: 206
-- Data for Name: postsRatings; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."postsRatings" ("idRating", "idPost", "userEmail", "valueRating") FROM stdin;
31	10	arti_man1997@mail.ru	5
32	11	arti_man1997@mail.ru	5
34	15	arti_man1997@mail.ru	5
\.


--
-- TOC entry 2849 (class 0 OID 0)
-- Dependencies: 205
-- Name: photoLabPosts_idPost_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."photoLabPosts_idPost_seq"', 15, true);


--
-- TOC entry 2850 (class 0 OID 0)
-- Dependencies: 204
-- Name: photoLabUsers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."photoLabUsers_id_seq"', 6, true);


--
-- TOC entry 2851 (class 0 OID 0)
-- Dependencies: 207
-- Name: postsRating_idRating_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."postsRating_idRating_seq"', 34, true);


--
-- TOC entry 2705 (class 2606 OID 16427)
-- Name: photoLabPosts photoLabPosts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."photoLabPosts"
    ADD CONSTRAINT "photoLabPosts_pkey" PRIMARY KEY ("idPost");


--
-- TOC entry 2703 (class 2606 OID 16419)
-- Name: photoLabUsers photoLabUsers_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."photoLabUsers"
    ADD CONSTRAINT "photoLabUsers_pkey" PRIMARY KEY (id);


--
-- TOC entry 2707 (class 2606 OID 16439)
-- Name: postsRatings postsRating_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."postsRatings"
    ADD CONSTRAINT "postsRating_pkey" PRIMARY KEY ("idRating");


--
-- TOC entry 2845 (class 0 OID 0)
-- Dependencies: 203
-- Name: TABLE "photoLabPosts"; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,INSERT,UPDATE ON TABLE public."photoLabPosts" TO "user";


--
-- TOC entry 2846 (class 0 OID 0)
-- Dependencies: 202
-- Name: TABLE "photoLabUsers"; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,INSERT,UPDATE ON TABLE public."photoLabUsers" TO "user";


--
-- TOC entry 2847 (class 0 OID 0)
-- Dependencies: 206
-- Name: TABLE "postsRatings"; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,INSERT ON TABLE public."postsRatings" TO "user";


--
-- TOC entry 2848 (class 0 OID 0)
-- Dependencies: 206 2847
-- Name: COLUMN "postsRatings"."idRating"; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT("idRating") ON TABLE public."postsRatings" TO "user";


-- Completed on 2021-04-20 22:48:43

--
-- PostgreSQL database dump complete
--

