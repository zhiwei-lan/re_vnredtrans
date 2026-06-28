-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- 主机： 1Panel-mysql-xidu
-- 生成日期： 2026-06-27 11:36:08
-- 服务器版本： 5.6.51-log
-- PHP 版本： 8.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `redtrans.vn`
--

-- --------------------------------------------------------

--
-- 表的结构 `articles`
--

CREATE TABLE `articles` (
  `id` int(11) UNSIGNED NOT NULL,
  `default_title` varchar(255) NOT NULL,
  `default_subject` varchar(255) DEFAULT NULL,
  `default_description` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `thumbnail_id` int(11) DEFAULT NULL,
  `excerpt` text,
  `category_id` int(11) UNSIGNED DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `view_count` int(11) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `is_main` tinyint(1) NOT NULL DEFAULT '0',
  `is_fixed` tinyint(1) NOT NULL DEFAULT '0',
  `sequence` int(11) DEFAULT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `published_ip` varchar(255) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `articles`
--

INSERT INTO `articles` (`id`, `default_title`, `default_subject`, `default_description`, `slug`, `thumbnail_id`, `excerpt`, `category_id`, `featured`, `view_count`, `active`, `is_main`, `is_fixed`, `sequence`, `created_by`, `created_at`, `updated_by`, `updated_at`, `published_ip`, `deleted_at`) VALUES
(388, '중국 공증서류', '중국 서류는 아포스티유로 정리가능합니다. ', '중국 서류도 레드트랜스가  전문적으로 처리가능합니다. ', '중국-공증서류-388', 578, NULL, 97, 0, 0, 1, 0, 0, 0, 94, '2026-02-25 10:19:38', 94, '2026-02-25 10:20:10', '119.112.223.231', NULL),
(389, '중국 취업서류', '중국 취업비자 발급에 필요한 서류', '중국 취업비자 발급에 필요한 서류를 위한 아포스티유 서비스를  제공합니다. ', '중국-취업서류-389', 579, NULL, 97, 0, 1, 1, 0, 0, 0, 94, '2026-02-25 10:22:03', 94, '2026-02-25 10:22:03', '119.112.223.231', NULL),
(390, '베트남어번역공증', '베트남 서류 통과 번역공증이 결정합니다', '베트남 입국·취업·유학·비즈니스를  준비할 때 가장 많이 실수하는 부분이  바로 번역 공증입니다. ', '베트남어번역공증-390', 582, NULL, 97, 0, 0, 1, 0, 0, 0, 94, '2026-02-25 10:28:37', 94, '2026-02-25 10:28:37', '119.112.223.231', NULL),
(391, '베트남어 번역', '혼자 준비하시기 어렵나요?', '실수 없이 빠르게 끝내려면 전문가와 시작하는 것이 가장 안전합니다. ', '베트남어-번역-391', 583, NULL, 97, 0, 0, 1, 0, 0, 0, 94, '2026-02-25 10:32:49', 94, '2026-02-25 10:32:49', '119.112.223.231', NULL),
(392, '베트남 위생허가 신청절차', '화장품 수출 필수 절차', '베트남에 식품·화장품을 수출하려면 모든 서류가 베트남어 번역 ,공증 , 대사관 영사확인을 거쳐야 합니다.', '베트남-위생허가-신청절차-392', 584, NULL, 97, 0, 1, 1, 0, 0, 0, 94, '2026-02-25 10:33:47', 94, '2026-02-25 10:33:47', '119.112.223.231', NULL),
(393, '베트남 경력 증명서 발급', '워크퍼밋에 꼭 필요합니다. ', '베트남은 외국인 근로자에게 직무 관련 경력 기준을 요구하며, 특히 전문직·중간관리직의 경우  2~5년 이상의 경력 증빙이  필수입니다.', '베트남-경력-증명서-발급-393', 585, NULL, 97, 0, 0, 1, 0, 0, 0, 94, '2026-02-25 10:34:43', 94, '2026-02-25 10:34:43', '119.112.223.231', NULL),
(394, ' 등록된 상표를 베트남 내에서 어떻게 활용할 수 있나요?', '', '', '등록된-상표를-베트남-내에서-어떻게-활용할-수-있나요-394', NULL, NULL, 90, 0, 0, 1, 0, 0, 0, 94, '2026-02-25 12:04:33', 94, '2026-02-25 12:04:33', '121.170.203.153', NULL),
(395, '상표등록이 승인되면 얼마나 보호받을 수 있나요?', '', '', '상표등록이-승인되면-얼마나-보호받을-수-있나요-395', NULL, NULL, 90, 0, 0, 1, 0, 0, 0, 94, '2026-02-25 12:05:17', 94, '2026-02-25 12:05:17', '121.170.203.153', NULL),
(396, '상표등록 비용은 어떻게 산정되나요?', '', '', '상표등록-비용은-어떻게-산정되나요-396', NULL, NULL, 90, 0, 0, 1, 0, 0, 0, 94, '2026-02-25 12:05:57', 94, '2026-02-25 12:05:57', '121.170.203.153', NULL),
(397, '외국 회사도 직접 베트남에서 상표를 등록할 수 있나요?', '', '', '외국-회사도-직접-베트남에서-상표를-등록할-수-있나요-397', NULL, NULL, 90, 0, 0, 1, 0, 0, 0, 94, '2026-02-25 12:06:23', 94, '2026-02-25 12:06:23', '121.170.203.153', NULL),
(398, '등록 가능한 상표의 기준은 무엇인가요?', '', '', '등록-가능한-상표의-기준은-무엇인가요-398', NULL, NULL, 90, 0, 0, 1, 0, 0, 0, 94, '2026-02-25 12:06:49', 94, '2026-02-25 12:06:49', '121.170.203.153', NULL),
(399, '등록하려는 상표가 이미 등록된 상표와 유사하면 어떻게 되나요?', '', '', '등록하려는-상표가-이미-등록된-상표와-유사하면-어떻게-되나요-399', NULL, NULL, 90, 0, 0, 1, 0, 0, 0, 94, '2026-02-25 12:07:22', 94, '2026-02-25 12:07:22', '121.170.203.153', NULL),
(400, '위생허가 등록은 얼마나 걸리나요?', '', '', '위생허가-등록은-얼마나-걸리나요-400', NULL, NULL, 90, 0, 0, 1, 0, 0, 0, 94, '2026-02-25 12:07:48', 94, '2026-02-25 12:07:48', '121.170.203.153', NULL),
(401, '상표등록 절차는 얼마나 걸리나요?', '', '', '상표등록-절차는-얼마나-걸리나요-401', NULL, NULL, 90, 0, 0, 1, 0, 0, 0, 94, '2026-02-25 12:08:12', 94, '2026-02-25 12:08:12', '121.170.203.153', NULL),
(402, '베트남에서 상표등록이 왜 필요한가요?', '', '', '베트남에서-상표등록이-왜-필요한가요-402', NULL, NULL, 90, 0, 0, 1, 0, 0, 0, 94, '2026-02-25 12:08:42', 94, '2026-02-26 12:35:50', '121.170.203.153', NULL),
(403, 'Story One', 'cate2', '', 'story-one-403', 587, NULL, 102, 0, 31, 1, 0, 0, 0, 94, '2026-02-25 15:18:21', 94, '2026-02-25 15:18:21', '121.170.203.153', NULL),
(404, 'Story Two', 'cate3', '', 'story-two-404', 588, NULL, 102, 0, 33, 1, 0, 0, 0, 94, '2026-02-25 15:26:21', 94, '2026-02-25 15:26:21', '121.170.203.153', NULL),
(405, 'Story Three', 'cate4', '', 'story-three-405', 589, NULL, 103, 0, 31, 1, 0, 0, 0, 94, '2026-02-25 15:29:36', 94, '2026-02-25 15:29:36', '121.170.203.153', NULL),
(406, 'Story Four', 'cate1', '', 'story-four-406', 590, NULL, 103, 0, 31, 1, 0, 0, 0, 94, '2026-02-25 15:31:46', 94, '2026-02-25 15:31:46', '121.170.203.153', NULL),
(407, 'Story Five', 'cate2', '', 'story-five-407', 591, NULL, 103, 0, 31, 1, 0, 0, 0, 94, '2026-02-25 15:42:54', 94, '2026-02-25 15:42:54', '121.170.203.153', NULL),
(408, 'Story Six', 'cate3', '', 'story-six-408', 592, NULL, 103, 0, 31, 1, 0, 0, 0, 94, '2026-02-25 15:45:07', 94, '2026-02-25 15:45:07', '121.170.203.153', NULL),
(409, 'Story Seven', 'cate2', '', 'story-seven-409', 593, NULL, 104, 0, 31, 1, 0, 0, 0, 94, '2026-02-25 15:49:26', 94, '2026-02-25 15:49:26', '121.170.203.153', NULL),
(410, 'Story Eight', 'cate4', '', 'story-eight-410', 594, NULL, 104, 0, 31, 1, 0, 0, 0, 94, '2026-02-25 16:00:11', 94, '2026-02-25 16:00:11', '121.170.203.153', NULL),
(411, 'Story Nine', 'cate1', '', 'story-nine-411', 595, NULL, 104, 0, 32, 1, 0, 0, 0, 94, '2026-02-25 16:02:13', 94, '2026-02-25 16:02:13', '121.170.203.153', NULL),
(412, 'Story Ten', 'cate2', '', 'story-ten-412', 596, NULL, 103, 0, 39, 1, 0, 0, 0, 94, '2026-02-25 16:03:33', 94, '2026-02-26 16:29:44', '121.170.203.153', NULL),
(413, '최소 자본금 기준이 있나요?', '', '', '최소-자본금-기준이-있나요-413', NULL, NULL, 106, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 10:49:43', 94, '2026-02-27 10:49:43', '119.112.223.231', NULL),
(414, '외국인 지분 100%로 설립이 가능한지, 꼭 베트남 파트너와 합작해야 하나요?', '', '', '외국인-지분-100로-설립이-가능한지-꼭-베트남-파트너와-합작해야-하나요-414', NULL, NULL, 106, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 10:50:17', 94, '2026-02-27 10:50:17', '119.112.223.231', NULL),
(415, '법인만 내면 바로 사업을 시작해도 되나요?', '', '', '법인만-내면-바로-사업을-시작해도-되나요-415', NULL, NULL, 106, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 10:51:07', 94, '2026-02-27 10:51:07', '119.112.223.231', NULL),
(416, '사무실 없이 사업 등록은 안되나요', '', '', '사무실-없이-사업-등록은-안되나요-416', NULL, NULL, 106, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 10:51:52', 94, '2026-02-27 10:51:52', '119.112.223.231', NULL),
(417, '시장 조사 및 비즈니스 계획 수립은 어떻게 하나요?', '', '', '시장-조사-및-비즈니스-계획-수립은-어떻게-하나요-417', NULL, NULL, 106, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 10:52:51', 94, '2026-02-27 10:52:51', '119.112.223.231', NULL),
(418, '회사 이름 선정 및 등록 시 주의할 점이 있나요?', '', '', '회사-이름-선정-및-등록-시-주의할-점이-있나요-418', NULL, NULL, 106, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 10:54:06', 94, '2026-02-27 10:54:06', '119.112.223.231', NULL),
(419, '법인 설립 신청서 제출은 어떻게 해야하나요?', '', '', '법인-설립-신청서-제출은-어떻게-해야하나요-419', NULL, NULL, 106, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 10:55:31', 94, '2026-02-27 10:55:31', '119.112.223.231', NULL),
(420, '투자청 심사 및 승인 절차에 대해 알려주세요', '', '', '투자청-심사-및-승인-절차에-대해-알려주세요-420', NULL, NULL, 106, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 10:57:06', 94, '2026-02-27 10:57:06', '119.112.223.231', NULL),
(421, '사업자 등록증 발급', '', '', '사업자-등록증-발급-421', NULL, NULL, 106, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 10:57:43', 94, '2026-02-27 10:57:43', '119.112.223.231', NULL),
(422, '세무 등록 절차는 어떻게 이루어지나요?', '', '', '세무-등록-절차는-어떻게-이루어지나요-422', NULL, NULL, 106, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 10:58:17', 94, '2026-02-27 10:58:17', '119.112.223.231', NULL),
(423, '사무 공간 및 위치 확보', '', '', '사무-공간-및-위치-확보-423', NULL, NULL, 106, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 10:58:50', 94, '2026-02-27 10:58:50', '119.112.223.231', NULL),
(424, '법규 준수 및 운영 관리', '', '', '법규-준수-및-운영-관리-424', NULL, NULL, 106, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 10:59:22', 94, '2026-02-27 10:59:22', '119.112.223.231', NULL),
(425, '법규 준수 및 운영 관리', '', '', '법규-준수-및-운영-관리-425', NULL, NULL, 106, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 10:59:50', 94, '2026-02-27 10:59:50', '119.112.223.231', NULL),
(426, '모든 화장품에 위생허가가 필요한가요?', '', '', '모든-화장품에-위생허가가-필요한가요-426', NULL, NULL, 107, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 11:06:16', 94, '2026-02-27 11:06:16', '119.112.223.231', NULL),
(427, '위생허가 등록은 얼마나 걸리나요?', '', '', '위생허가-등록은-얼마나-걸리나요-427', NULL, NULL, 107, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 11:06:55', 94, '2026-02-27 11:06:55', '119.112.223.231', NULL),
(428, '위생허가는 몇 년 동안 유효한가요?', '', '', '위생허가는-몇-년-동안-유효한가요-428', NULL, NULL, 107, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 11:07:34', 94, '2026-02-27 11:07:34', '119.112.223.231', NULL),
(429, '위생허가를 신청하려면 현지 대리인이 필요한가요?', '', '', '위생허가를-신청하려면-현지-대리인이-필요한가요-429', NULL, NULL, 107, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 11:08:19', 94, '2026-02-27 11:08:19', '119.112.223.231', NULL),
(430, '허가가 거절될 수 있는 이유는 무엇인가요?', '', '', '허가가-거절될-수-있는-이유는-무엇인가요-430', NULL, NULL, 107, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 11:08:49', 94, '2026-02-27 11:08:49', '119.112.223.231', NULL),
(431, '위생허가를 받은 후 추가로 해야 할 절차가 있나요?', '', '', '위생허가를-받은-후-추가로-해야-할-절차가-있나요-431', NULL, NULL, 107, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 11:10:46', 94, '2026-02-27 11:10:46', '119.112.223.231', NULL),
(432, '동일 제품의 다양한 색상이나 향도 각각 등록해야 하나요?', '', '', '동일-제품의-다양한-색상이나-향도-각각-등록해야-하나요-432', NULL, NULL, 107, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 11:11:29', 94, '2026-02-27 11:11:29', '119.112.223.231', NULL),
(433, '세금은 어떻게 처리해야 하나요?', '', '', '세금은-어떻게-처리해야-하나요-433', NULL, NULL, 106, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 11:13:03', 94, '2026-02-27 11:13:03', '119.112.223.231', NULL),
(434, '법률 자문 및 전문가 상담은 꼭 받아야 하나요?', '', '', '법률-자문-및-전문가-상담은-꼭-받아야-하나요-434', NULL, NULL, 106, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 11:13:46', 94, '2026-02-27 11:13:46', '119.112.223.231', NULL),
(435, '자본금 설정 및 예치 요건을 알려주세요', '', '', '자본금-설정-및-예치-요건을-알려주세요-435', NULL, NULL, 106, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 11:14:24', 94, '2026-02-27 11:14:24', '119.112.223.231', NULL),
(436, '위생허가 등록에 필요한 주요 서류는 무엇인가요?', '', '', '위생허가-등록에-필요한-주요-서류는-무엇인가요-436', NULL, NULL, 107, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 11:15:00', 94, '2026-02-27 11:15:00', '119.112.223.231', NULL),
(437, '위생허가 등록 비용은 얼마인가요?', '', '', '위생허가-등록-비용은-얼마인가요-437', NULL, NULL, 107, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 11:15:34', 94, '2026-02-27 11:15:34', '119.112.223.231', NULL),
(438, '등록한 위생허가를 다른 제품에도 사용할 수 있나요?', '', '', '등록한-위생허가를-다른-제품에도-사용할-수-있나요-438', NULL, NULL, 107, 0, 0, 1, 0, 0, 0, 94, '2026-02-27 11:16:08', 94, '2026-02-27 11:16:08', '119.112.223.231', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `articles_lang`
--

CREATE TABLE `articles_lang` (
  `id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `lang` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content_delta` longtext,
  `content_html` longtext,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `articles_lang`
--

INSERT INTO `articles_lang` (`id`, `article_id`, `lang`, `title`, `content_delta`, `content_html`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`, `created_by`, `updated_by`, `subject`, `description`) VALUES
(379, 381, 'ko', '인삼에는 산의 영혼이 담겨 있습니다', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"주요 사용 용도\"},{\"attributes\":{\"header\":1},\"insert\":\"\\n\"},{\"insert\":\"\\n\\n\\n\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"흑삼 농축액\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"insert\":\"\\n\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"면역력 향상\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"피로 개선\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"혈소판 응집을 억제하여 혈액 순환\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"기억력 향상\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"노화 방지\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"담낭, 간암 등을 억제\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"insert\":\"\\n\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"인삼 농축액\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"insert\":\"\\n\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"한국 인삼 베리: 4년근 인삼 식물에 7월 중순에 약 일주일 정도만 피는 희귀 과일\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"강력한 항산화 효과, 유해한 활성산소 제거, 노화 관련 유전자 억제, 노화 방지 유전자 활성화\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"미국에서 항당뇨병 및 항비만 효과가 있는 것으로 입증되었습니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', '<h1><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">주요 사용 용도</span></h1><p></p><p></p><p></p><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">흑삼 농축액</span></h2><p></p><p></p><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">면역력 향상</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">피로 개선</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">혈소판 응집을 억제하여 혈액 순환</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">기억력 향상</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">노화 방지</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">담낭, 간암 등을 억제</span></li></ul><h2></h2><p></p><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">인삼 농축액</span></h2><p></p><p></p><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">한국 인삼 베리: 4년근 인삼 식물에 7월 중순에 약 일주일 정도만 피는 희귀 과일</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">강력한 항산화 효과, 유해한 활성산소 제거, 노화 관련 유전자 억제, 노화 방지 유전자 활성화</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">미국에서 항당뇨병 및 항비만 효과가 있는 것으로 입증되었습니다.</span></li></ul><p></p>', '', '', '', '2026-02-03 10:26:41', '2026-02-04 11:10:01', 94, 95, '', '유형: 홍삼 음료  | 포장: 30팩 x 20ml |권장 소매 가격: 390,000원 | 주성분: 흑삼 농축액, 한국 인삼 베리 농축액'),
(380, 382, 'ko', '라온 티', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"주요 사용 용도\"},{\"attributes\":{\"header\":1},\"insert\":\"\\n\"},{\"insert\":\"\\n\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"흑삼 농축액\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"면역 체계 강화\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"피로를 회복\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"혈소판 응집을 억제하여 혈액 순환\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"기억력 향상\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"항산화 활동\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"담낭과 간암 등을 억제\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"인삼 농축액\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"인삼 열매: 4년근 인삼 식물에 7월 중순에 약 일주일 동안 피는 희귀한 열매\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"강력한 항산화 효과, 유해한 활성산소 제거, 노화 유전자 억제, 노화 방지 유전자 활성화 등의 효과가 있습니다\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"미국에서 항당뇨병 및 항비만 효과가 있는 것으로 입증되었습니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', '<h1><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">주요 사용 용도</span></h1><p></p><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">흑삼 농축액</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">면역 체계 강화</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">피로를 회복</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">혈소판 응집을 억제하여 혈액 순환</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">기억력 향상</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">항산화 활동</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">담낭과 간암 등을 억제</span></li></ul><h2></h2><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">인삼 농축액</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">인삼 열매: 4년근 인삼 식물에 7월 중순에 약 일주일 동안 피는 희귀한 열매</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">강력한 항산화 효과, 유해한 활성산소 제거, 노화 유전자 억제, 노화 방지 유전자 활성화 등의 효과가 있습니다</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">미국에서 항당뇨병 및 항비만 효과가 있는 것으로 입증되었습니다.</span></li></ul><p></p>', '', '', '', '2026-02-03 10:36:54', '2026-02-04 11:09:51', 94, 95, '', '유형: 솔리드 티 |포장: 60포 x 10g |권장 소매 가격: 156,000원 |주성분: 농축 식물성 분말 블렌드(셀러리, 호박, 팥), 자일리톨'),
(381, 383, 'ko', '부브람 차', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"주요 사용 용도\"},{\"attributes\":{\"header\":1},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"흑삼 농축액\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"면역력 향상\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"피로 개선\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"혈소판 응집을 억제하여 혈액 순환\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"기억력 향상\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"노화 방지\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"담낭, 간암 등을 억제\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"인삼 농축액\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"한국 인삼 베리: 4년근 인삼 식물에 7월 중순에 약 일주일 정도만 피는 희귀 과일\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"강력한 항산화 효과, 유해한 활성산소 제거, 노화 관련 유전자 억제, 노화 방지 유전자 활성화\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"미국에서 항당뇨병 및 항비만 효과가 있는 것으로 입증되었습니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', '<h1><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">주요 사용 용도</span></h1><p></p><h2></h2><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">흑삼 농축액</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">면역력 향상</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">피로 개선</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">혈소판 응집을 억제하여 혈액 순환</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">기억력 향상</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">노화 방지</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">담낭, 간암 등을 억제</span></li></ul><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">인삼 농축액</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">한국 인삼 베리: 4년근 인삼 식물에 7월 중순에 약 일주일 정도만 피는 희귀 과일</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">강력한 항산화 효과, 유해한 활성산소 제거, 노화 관련 유전자 억제, 노화 방지 유전자 활성화</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">미국에서 항당뇨병 및 항비만 효과가 있는 것으로 입증되었습니다.</span></li></ul><p></p>', '', '', '', '2026-02-03 10:39:10', '2026-02-04 11:09:40', 94, 95, '', '유형: 홍삼 음료 | 포장: 30포 x 20ml |권장 소매  가격: 390,000원 | 주성분: 흑삼 농축액, 인삼 과일 농축액'),
(382, 384, 'ko', '나홍삼', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"주요 사용 용도\"},{\"attributes\":{\"header\":1},\"insert\":\"\\n\"},{\"insert\":\"\\n\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"석류 농축액\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"식물 식물성 에스트로겐의 일종인 엘라직산은 여성의 갱년기 증상(열감, 생리 불순, 불면증, 골다공증 등)을 줄이는 데 도움이 됩니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"강력한 항산화제는 유방, 피부, 식도, 대장, 전립선, 췌장에서 암세포 활동을 억제합니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"면역력의 필수 요소인 아연 함량은 키위보다 2.5배 높습니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"세븐베리 컨센트레이터\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"폴리페놀은 장에서 지방 흡수를 억제하고 에너지 소비를 촉진하며 과도한 지방을 연소시켜 체중 감소, 혈액 순환을 촉진하고 부종을 예방합니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"항산화 특성을 가진 안토시아닌, 리그난 등이 풍부하며, 활성산소를 중화시키고 노화를 늦추며 면역력을 증진시킵니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"비타민 A 함량이 높으면 눈의 피로를 줄이고 시력을 개선하는 데 도움이 됩니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"안토시아닌은 혈관에서 잔여물과 독소를 제거하고, 혈관을 강화하며, LDL 콜레스테롤 수치를 낮춥니다. → 혈액 순환을 개선하고 만성 질환(동맥경화증, 고혈압, 지질 장애, 당뇨병, 심정지, 심근경색, 뇌졸중 등)을 예방합니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"풍부한 비타민 C는 활성산소를 중화시키고 노화를 방지합니다\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"세븐베리 컨센트레이터\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"하이드록시시트르산은 탄수화물 대사를 늦추고 식욕을 억제하며, 풍부한 칼륨은 체내 축적된 노폐물을 제거하는 데 도움이 됩니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"항염증 및 항균 특성이 있어 피부 면역력을 강화합니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"콜라겐\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"피부, 뼈, 혈관에서 발견되는 신체에 탄력을 제공하는 단백질 중 하나로, 세포를 연결하는 역할을 합니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"탄력이 있어 피부를 탄력 있게 유지합니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"관절 통증을 진정시킵니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"튼튼한 뼈를 지지합니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"혈관의 부드러움을 유지하여 동맥경화를 예방합니다\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', '<h1><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">주요 사용 용도</span></h1><p></p><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">석류 농축액</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">식물 식물성 에스트로겐의 일종인 엘라직산은 여성의 갱년기 증상(열감, 생리 불순, 불면증, 골다공증 등)을 줄이는 데 도움이 됩니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">강력한 항산화제는 유방, 피부, 식도, 대장, 전립선, 췌장에서 암세포 활동을 억제합니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">면역력의 필수 요소인 아연 함량은 키위보다 2.5배 높습니다.</span></li></ul><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">세븐베리 컨센트레이터</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">폴리페놀은 장에서 지방 흡수를 억제하고 에너지 소비를 촉진하며 과도한 지방을 연소시켜 체중 감소, 혈액 순환을 촉진하고 부종을 예방합니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">항산화 특성을 가진 안토시아닌, 리그난 등이 풍부하며, 활성산소를 중화시키고 노화를 늦추며 면역력을 증진시킵니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">비타민 A 함량이 높으면 눈의 피로를 줄이고 시력을 개선하는 데 도움이 됩니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">안토시아닌은 혈관에서 잔여물과 독소를 제거하고, 혈관을 강화하며, LDL 콜레스테롤 수치를 낮춥니다. → 혈액 순환을 개선하고 만성 질환(동맥경화증, 고혈압, 지질 장애, 당뇨병, 심정지, 심근경색, 뇌졸중 등)을 예방합니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">풍부한 비타민 C는 활성산소를 중화시키고 노화를 방지합니다</span></li></ul><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">세븐베리 컨센트레이터</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">하이드록시시트르산은 탄수화물 대사를 늦추고 식욕을 억제하며, 풍부한 칼륨은 체내 축적된 노폐물을 제거하는 데 도움이 됩니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">항염증 및 항균 특성이 있어 피부 면역력을 강화합니다.</span></li></ul><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">콜라겐</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">피부, 뼈, 혈관에서 발견되는 신체에 탄력을 제공하는 단백질 중 하나로, 세포를 연결하는 역할을 합니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">탄력이 있어 피부를 탄력 있게 유지합니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">관절 통증을 진정시킵니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">튼튼한 뼈를 지지합니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">혈관의 부드러움을 유지하여 동맥경화를 예방합니다</span></li></ul><p></p>', '', '', '', '2026-02-03 16:07:07', '2026-02-03 16:11:17', 94, 94, '', ' 유형: 캔디 |포장: 10개 x 20g |권장 소매 가격: 35,000원 |주성분: 석류 농축액, 세븐베리 농축액, 히비스커스 농축액, 콜라겐'),
(383, 385, 'ko', '사포닌 900', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"주요 사용 용도\"},{\"attributes\":{\"header\":1},\"insert\":\"\\n\"},{\"insert\":\"\\n\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"6년근 홍삼 농축액\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"피로를 줄이는 데 도움이 됩니다\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"혈소판 응집을 억제하여 혈액 순환을 지원\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"기억력 향상\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"항산화 지원\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"배양된 산삼 뿌리 농축액\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"배양 산삼 뿌리는 국내 120년 된 천연 산삼의 뿌리 세포를 무균 배양해 배양한 것입니다. 천연 산삼의 유전 물질을 99.8% 보유하고 있어 본래의 효능과 유전적 특성을 그대로 유지하고 있습니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"한국 식품의약품안전처로부터 \\\"산삼 재배 뿌리\\\"라는 이름으로 사용 승인을 받았습니다\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"미국 FDA 안전성 테스트를 통과하여 국제적인 신뢰를 얻었습니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"재배된 산삼 뿌리는 멸균 수경 재배 방법을 사용하여 재배되므로 다른 종류의 홍삼과 달리 농약 잔류물이 전혀 없습니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', '<h1><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">주요&nbsp;사용&nbsp;용도</span></h1><p></p><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">6년근&nbsp;홍삼&nbsp;농축액</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">피로를&nbsp;줄이는&nbsp;데&nbsp;도움이&nbsp;됩니다</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">혈소판&nbsp;응집을&nbsp;억제하여&nbsp;혈액&nbsp;순환을&nbsp;지원</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">기억력&nbsp;향상</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">항산화&nbsp;지원</span></li></ul><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">배양된&nbsp;산삼&nbsp;뿌리&nbsp;농축액</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">배양&nbsp;산삼&nbsp;뿌리는&nbsp;국내&nbsp;120년&nbsp;된&nbsp;천연&nbsp;산삼의&nbsp;뿌리&nbsp;세포를&nbsp;무균&nbsp;배양해&nbsp;배양한&nbsp;것입니다.&nbsp;천연&nbsp;산삼의&nbsp;유전&nbsp;물질을&nbsp;99.8%&nbsp;보유하고&nbsp;있어&nbsp;본래의&nbsp;효능과&nbsp;유전적&nbsp;특성을&nbsp;그대로&nbsp;유지하고&nbsp;있습니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">한국&nbsp;식품의약품안전처로부터&nbsp;&quot;산삼&nbsp;재배&nbsp;뿌리&quot;라는&nbsp;이름으로&nbsp;사용&nbsp;승인을&nbsp;받았습니다</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">미국&nbsp;FDA&nbsp;안전성&nbsp;테스트를&nbsp;통과하여&nbsp;국제적인&nbsp;신뢰를&nbsp;얻었습니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">재배된&nbsp;산삼&nbsp;뿌리는&nbsp;멸균&nbsp;수경&nbsp;재배&nbsp;방법을&nbsp;사용하여&nbsp;재배되므로&nbsp;다른&nbsp;종류의&nbsp;홍삼과&nbsp;달리&nbsp;농약&nbsp;잔류물이&nbsp;전혀&nbsp;없습니다.</span></li></ul><p></p>', '', '', '', '2026-02-03 16:09:57', '2026-02-03 16:09:57', 94, NULL, '', '유형: 홍삼 음료 |포장: 30팩 x 70ml  |권장 소매 가격: 350,000원  |주성분: 6년근 홍삼 농축액, 배양 산삼 뿌리 농축액'),
(384, 386, 'ko', '예쁜 석류', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"재료의 주요 용도\"},{\"attributes\":{\"header\":1},\"insert\":\"\\n\"},{\"insert\":\"\\n\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"석류 농축액\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"식물 식물성 에스트로겐의 일종인 엘라직산은 여성의 갱년기 증상(열감, 생리 불순, 불면증, 골다공증 등)을 줄이는 데 도움이 됩니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"강력한 항산화제는 유방, 피부, 식도, 대장, 전립선, 췌장에서 암세포의 활동을 억제합니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"면역력의 필수 요소인 아연 함량은 키위보다 2.5배 높습니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"세븐베리 컨센트레이터\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"폴리페놀은 장에서 지방 흡수를 억제하고 에너지 소비를 촉진하며 과도한 지방을 연소시켜 체중 감량을 촉진하고 혈액 순환을 개선하며 부종을 예방하는 데 도움이 됩니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"안토시아닌이 풍부한 리그난은 항산화제로 작용하여 활성산소를 중화시키고 노화를 늦추며 면역력을 증진시킵니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"비타민 A 함량이 높으면 눈의 피로를 줄이고 시력을 개선하는 데 도움이 됩니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"안토시아닌은 혈관에서 노폐물과 독소를 제거하고, 혈관을 강화하며, LDL 콜레스테롤을 낮추고 → 순환을 개선하며, 만성 질환(동맥경화증, 고혈압, 지질 장애, 당뇨병, 심정지, 심근경색, 뇌졸중 등)을 예방합니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"풍부한 비타민 C는 활성산소를 중화시키고 노화를 방지합니다\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"히비스커스 농축액\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"하이드록시시트르산은 탄수화물 대사를 늦추고 식욕을 억제하며, 풍부한 칼륨은 체내 축적된 노폐물을 제거하는 데 도움이 됩니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"항염증 및 항균 특성이 있어 피부 면역력을 지원합니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"콜라겐\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"피부, 뼈, 혈관에서 발견되는 신체에 탄력을 제공하고 세포를 연결하는 역할을 하는 단백질 중 하나입니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"탄력을 제공하여 피부를 탄력 있게 유지합니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"관절 통증을 진정시킵니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"뼈를 강화하는 데 도움이 됩니다.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"혈관의 부드러움을 유지하여 동맥경화를 예방합니다\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', '<h1><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">재료의&nbsp;주요&nbsp;용도</span></h1><p></p><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">석류&nbsp;농축액</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">식물&nbsp;식물성&nbsp;에스트로겐의&nbsp;일종인&nbsp;엘라직산은&nbsp;여성의&nbsp;갱년기&nbsp;증상(열감,&nbsp;생리&nbsp;불순,&nbsp;불면증,&nbsp;골다공증&nbsp;등)을&nbsp;줄이는&nbsp;데&nbsp;도움이&nbsp;됩니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">강력한&nbsp;항산화제는&nbsp;유방,&nbsp;피부,&nbsp;식도,&nbsp;대장,&nbsp;전립선,&nbsp;췌장에서&nbsp;암세포의&nbsp;활동을&nbsp;억제합니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">면역력의&nbsp;필수&nbsp;요소인&nbsp;아연&nbsp;함량은&nbsp;키위보다&nbsp;2.5배&nbsp;높습니다.</span></li></ul><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">세븐베리&nbsp;컨센트레이터</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">폴리페놀은&nbsp;장에서&nbsp;지방&nbsp;흡수를&nbsp;억제하고&nbsp;에너지&nbsp;소비를&nbsp;촉진하며&nbsp;과도한&nbsp;지방을&nbsp;연소시켜&nbsp;체중&nbsp;감량을&nbsp;촉진하고&nbsp;혈액&nbsp;순환을&nbsp;개선하며&nbsp;부종을&nbsp;예방하는&nbsp;데&nbsp;도움이&nbsp;됩니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">안토시아닌이&nbsp;풍부한&nbsp;리그난은&nbsp;항산화제로&nbsp;작용하여&nbsp;활성산소를&nbsp;중화시키고&nbsp;노화를&nbsp;늦추며&nbsp;면역력을&nbsp;증진시킵니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">비타민&nbsp;A&nbsp;함량이&nbsp;높으면&nbsp;눈의&nbsp;피로를&nbsp;줄이고&nbsp;시력을&nbsp;개선하는&nbsp;데&nbsp;도움이&nbsp;됩니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">안토시아닌은&nbsp;혈관에서&nbsp;노폐물과&nbsp;독소를&nbsp;제거하고,&nbsp;혈관을&nbsp;강화하며,&nbsp;LDL&nbsp;콜레스테롤을&nbsp;낮추고&nbsp;→&nbsp;순환을&nbsp;개선하며,&nbsp;만성&nbsp;질환(동맥경화증,&nbsp;고혈압,&nbsp;지질&nbsp;장애,&nbsp;당뇨병,&nbsp;심정지,&nbsp;심근경색,&nbsp;뇌졸중&nbsp;등)을&nbsp;예방합니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">풍부한&nbsp;비타민&nbsp;C는&nbsp;활성산소를&nbsp;중화시키고&nbsp;노화를&nbsp;방지합니다</span></li></ul><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">히비스커스&nbsp;농축액</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">하이드록시시트르산은&nbsp;탄수화물&nbsp;대사를&nbsp;늦추고&nbsp;식욕을&nbsp;억제하며,&nbsp;풍부한&nbsp;칼륨은&nbsp;체내&nbsp;축적된&nbsp;노폐물을&nbsp;제거하는&nbsp;데&nbsp;도움이&nbsp;됩니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">항염증&nbsp;및&nbsp;항균&nbsp;특성이&nbsp;있어&nbsp;피부&nbsp;면역력을&nbsp;지원합니다.</span></li></ul><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">콜라겐</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">피부,&nbsp;뼈,&nbsp;혈관에서&nbsp;발견되는&nbsp;신체에&nbsp;탄력을&nbsp;제공하고&nbsp;세포를&nbsp;연결하는&nbsp;역할을&nbsp;하는&nbsp;단백질&nbsp;중&nbsp;하나입니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">탄력을&nbsp;제공하여&nbsp;피부를&nbsp;탄력&nbsp;있게&nbsp;유지합니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">관절&nbsp;통증을&nbsp;진정시킵니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">뼈를&nbsp;강화하는&nbsp;데&nbsp;도움이&nbsp;됩니다.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">혈관의&nbsp;부드러움을&nbsp;유지하여&nbsp;동맥경화를&nbsp;예방합니다</span></li></ul><p></p>', '', '', '', '2026-02-03 16:12:11', '2026-02-04 11:09:00', 94, 95, '', '유형: 캔디 |포장: 10정 x 20g |권장 소매 가격: 35,000원 |주성분: 석류 농축액, 세븐베리 농축액, 히비스커스 농축액, 콜라겐'),
(386, 381, 'en', 'Ginseng contains the soul of the mountain', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"KEY USE OF THE MATERIAL\"},{\"attributes\":{\"header\":1},\"insert\":\"\\n\"},{\"insert\":\"\\n\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Black ginseng concentrate\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Support for increased immunity\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Support to improve fatigue\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Supporting blood circulation by inhibiting platelet aggregation\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Support for Memory Improvement\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Anti-oxidation support\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Support to inhibit gallbladder, liver cancer, etc.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Ginseng concentrated fluid\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Korean ginseng berry: a rare fruit that only blooms for about one week in mid-July on 4-year-old ginseng plants\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Powerful antioxidant effects, eliminating harmful free radicals, inhibiting aging-related genes, and activating anti-aging genes\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Proven in the U.S. to have anti-diabetic and anti-obesity effects\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', '<h1><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">KEY&nbsp;USE&nbsp;OF&nbsp;THE&nbsp;MATERIAL</span></h1><p></p><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Black&nbsp;ginseng&nbsp;concentrate</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Support&nbsp;for&nbsp;increased&nbsp;immunity</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Support&nbsp;to&nbsp;improve&nbsp;fatigue</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Supporting&nbsp;blood&nbsp;circulation&nbsp;by&nbsp;inhibiting&nbsp;platelet&nbsp;aggregation</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Support&nbsp;for&nbsp;Memory&nbsp;Improvement</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Anti-oxidation&nbsp;support</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Support&nbsp;to&nbsp;inhibit&nbsp;gallbladder,&nbsp;liver&nbsp;cancer,&nbsp;etc.</span></li></ul><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Ginseng&nbsp;concentrated&nbsp;fluid</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Korean&nbsp;ginseng&nbsp;berry:&nbsp;a&nbsp;rare&nbsp;fruit&nbsp;that&nbsp;only&nbsp;blooms&nbsp;for&nbsp;about&nbsp;one&nbsp;week&nbsp;in&nbsp;mid-July&nbsp;on&nbsp;4-year-old&nbsp;ginseng&nbsp;plants</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Powerful&nbsp;antioxidant&nbsp;effects,&nbsp;eliminating&nbsp;harmful&nbsp;free&nbsp;radicals,&nbsp;inhibiting&nbsp;aging-related&nbsp;genes,&nbsp;and&nbsp;activating&nbsp;anti-aging&nbsp;genes</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Proven&nbsp;in&nbsp;the&nbsp;U.S.&nbsp;to&nbsp;have&nbsp;anti-diabetic&nbsp;and&nbsp;anti-obesity&nbsp;effects</span></li></ul><p></p>', '', '', '', '2026-02-03 17:48:42', '2026-02-03 17:48:42', 94, NULL, '', 'Type: Red Ginseng Drink |Packaging: 30 packs x 20 ml |Suggested Retail Price: 390,000 KRW| Main Ingredients: Black ginseng concentrate, Korean ginseng berry concentrate'),
(387, 382, 'en', 'Ra-on tea', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"KEY USE OF THE MATERIAL\"},{\"attributes\":{\"header\":1},\"insert\":\"\\n\"},{\"insert\":\"\\n\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Black ginseng concentrate\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Supports immune system enhancement\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Helps reduce fatigue\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Supports blood circulation by inhibiting platelet aggregation\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Helps improve memory\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Supports antioxidant activity\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Helps inhibit gallbladder and liver cancer, among others\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Ginseng concentrated fluid\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Ginseng fruit: a rare fruit that blooms for about one week in mid-July on 4-year-old ginseng plants\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Has strong antioxidant effects, eliminates harmful free radicals, inhibits aging genes, and activates anti-aging genes\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Proven in the U.S. to have anti-diabetic and anti-obesity effects\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', '<h1><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">KEY&nbsp;USE&nbsp;OF&nbsp;THE&nbsp;MATERIAL</span></h1><p></p><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Black&nbsp;ginseng&nbsp;concentrate</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Supports&nbsp;immune&nbsp;system&nbsp;enhancement</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Helps&nbsp;reduce&nbsp;fatigue</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Supports&nbsp;blood&nbsp;circulation&nbsp;by&nbsp;inhibiting&nbsp;platelet&nbsp;aggregation</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Helps&nbsp;improve&nbsp;memory</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Supports&nbsp;antioxidant&nbsp;activity</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Helps&nbsp;inhibit&nbsp;gallbladder&nbsp;and&nbsp;liver&nbsp;cancer,&nbsp;among&nbsp;others</span></li></ul><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Ginseng&nbsp;concentrated&nbsp;fluid</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Ginseng&nbsp;fruit:&nbsp;a&nbsp;rare&nbsp;fruit&nbsp;that&nbsp;blooms&nbsp;for&nbsp;about&nbsp;one&nbsp;week&nbsp;in&nbsp;mid-July&nbsp;on&nbsp;4-year-old&nbsp;ginseng&nbsp;plants</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Has&nbsp;strong&nbsp;antioxidant&nbsp;effects,&nbsp;eliminates&nbsp;harmful&nbsp;free&nbsp;radicals,&nbsp;inhibits&nbsp;aging&nbsp;genes,&nbsp;and&nbsp;activates&nbsp;anti-aging&nbsp;genes</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Proven&nbsp;in&nbsp;the&nbsp;U.S.&nbsp;to&nbsp;have&nbsp;anti-diabetic&nbsp;and&nbsp;anti-obesity&nbsp;effects</span></li></ul><p></p>', '', '', '', '2026-02-03 17:49:39', '2026-02-03 17:49:39', 94, NULL, '', ' Type: Solid Tea |Packaging: 60 sachets x 10 g |Suggested Retail Price: 156,000 KRW |Main Ingredients: Concentrated plant powder blend (celery, pumpkin, red beans), xylitol'),
(388, 383, 'en', 'Ginseng contains the soul of the mountain', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"KEY USE OF THE MATERIAL\"},{\"attributes\":{\"header\":1},\"insert\":\"\\n\"},{\"insert\":\"\\n\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Black ginseng concentrate\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Support for increased immunity\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Support to improve fatigue\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Supporting blood circulation by inhibiting platelet aggregation\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Support for Memory Improvement\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Anti-oxidation support\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Support to inhibit gallbladder, liver cancer, etc.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Ginseng concentrated fluid\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Korean ginseng berry: a rare fruit that only blooms for about one week in mid-July on 4-year-old ginseng plants\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Powerful antioxidant effects, eliminating harmful free radicals, inhibiting aging-related genes, and activating anti-aging genes\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Proven in the U.S. to have anti-diabetic and anti-obesity effects\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', '<h1><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">KEY&nbsp;USE&nbsp;OF&nbsp;THE&nbsp;MATERIAL</span></h1><p></p><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Black&nbsp;ginseng&nbsp;concentrate</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Support&nbsp;for&nbsp;increased&nbsp;immunity</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Support&nbsp;to&nbsp;improve&nbsp;fatigue</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Supporting&nbsp;blood&nbsp;circulation&nbsp;by&nbsp;inhibiting&nbsp;platelet&nbsp;aggregation</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Support&nbsp;for&nbsp;Memory&nbsp;Improvement</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Anti-oxidation&nbsp;support</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Support&nbsp;to&nbsp;inhibit&nbsp;gallbladder,&nbsp;liver&nbsp;cancer,&nbsp;etc.</span></li></ul><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Ginseng&nbsp;concentrated&nbsp;fluid</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Korean&nbsp;ginseng&nbsp;berry:&nbsp;a&nbsp;rare&nbsp;fruit&nbsp;that&nbsp;only&nbsp;blooms&nbsp;for&nbsp;about&nbsp;one&nbsp;week&nbsp;in&nbsp;mid-July&nbsp;on&nbsp;4-year-old&nbsp;ginseng&nbsp;plants</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Powerful&nbsp;antioxidant&nbsp;effects,&nbsp;eliminating&nbsp;harmful&nbsp;free&nbsp;radicals,&nbsp;inhibiting&nbsp;aging-related&nbsp;genes,&nbsp;and&nbsp;activating&nbsp;anti-aging&nbsp;genes</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Proven&nbsp;in&nbsp;the&nbsp;U.S.&nbsp;to&nbsp;have&nbsp;anti-diabetic&nbsp;and&nbsp;anti-obesity&nbsp;effects</span></li></ul><p></p>', '', '', '', '2026-02-03 17:50:39', '2026-02-03 17:50:39', 94, NULL, '', 'Type: Red Ginseng Drink |Packaging: 30 packs x 20 ml |Suggested Retail Price: 390,000 KRW |Main Ingredients: Black ginseng concentrate, Korean ginseng berry concentrate');
INSERT INTO `articles_lang` (`id`, `article_id`, `lang`, `title`, `content_delta`, `content_html`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`, `created_by`, `updated_by`, `subject`, `description`) VALUES
(389, 384, 'en', 'Na-Hong-sam', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Main use of materials\"},{\"attributes\":{\"header\":1},\"insert\":\"\\n\"},{\"insert\":\"\\n\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Pomegranate concentrated fluid\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Ellagic acid – a type of plant phytoestrogen – helps reduce menopausal symptoms in women (hot flashes, menstrual irregularities, insomnia, osteoporosis, etc.).\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Strong antioxidant, inhibits cancer cell activity in the breast, skin, esophagus, colon, prostate, and pancreas.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Zinc content – an essential element for immunity – is 2.5 times higher than in kiwi.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Seven-Berry Concentrator\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Polyphenols inhibit fat absorption in the intestines, promote energy expenditure, and burn excess fat → support weight loss, blood circulation, and prevent edema.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Rich in anthocyanins, lignans, etc., with antioxidant properties, neutralizing free radicals, slowing aging, and boosting immunity.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"High vitamin A content helps reduce eye fatigue and improve vision.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Anthocyanins remove residues and toxins from blood vessels, strengthen blood vessels, lower LDL cholesterol → enhance circulation and prevent chronic diseases (atherosclerosis, hypertension, lipid disorders, diabetes, cardiac arrest, myocardial infarction, stroke, etc.).\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Abundant vitamin C neutralizes free radicals and combats aging.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Hibiscus concentrate\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hydroxycitric acid slows carbohydrate metabolism → suppresses appetite; abundant potassium helps eliminate accumulated waste in the body.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Has anti-inflammatory and antibacterial properties, supporting enhanced skin immunity.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Collagen\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"One of the proteins that provides elasticity to the body, found in skin, bones, blood vessels…, playing a role in connecting cells.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Has elasticity, helping the skin stay firm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Soothes joint pain.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Supports strong bones.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Maintains softness in blood vessels, preventing arteriosclerosis.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', '<h1><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Main&nbsp;use&nbsp;of&nbsp;materials</span></h1><p></p><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Pomegranate&nbsp;concentrated&nbsp;fluid</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Ellagic&nbsp;acid&nbsp;–&nbsp;a&nbsp;type&nbsp;of&nbsp;plant&nbsp;phytoestrogen&nbsp;–&nbsp;helps&nbsp;reduce&nbsp;menopausal&nbsp;symptoms&nbsp;in&nbsp;women&nbsp;(hot&nbsp;flashes,&nbsp;menstrual&nbsp;irregularities,&nbsp;insomnia,&nbsp;osteoporosis,&nbsp;etc.).</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Strong&nbsp;antioxidant,&nbsp;inhibits&nbsp;cancer&nbsp;cell&nbsp;activity&nbsp;in&nbsp;the&nbsp;breast,&nbsp;skin,&nbsp;esophagus,&nbsp;colon,&nbsp;prostate,&nbsp;and&nbsp;pancreas.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Zinc&nbsp;content&nbsp;–&nbsp;an&nbsp;essential&nbsp;element&nbsp;for&nbsp;immunity&nbsp;–&nbsp;is&nbsp;2.5&nbsp;times&nbsp;higher&nbsp;than&nbsp;in&nbsp;kiwi.</span></li></ul><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Seven-Berry&nbsp;Concentrator</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Polyphenols&nbsp;inhibit&nbsp;fat&nbsp;absorption&nbsp;in&nbsp;the&nbsp;intestines,&nbsp;promote&nbsp;energy&nbsp;expenditure,&nbsp;and&nbsp;burn&nbsp;excess&nbsp;fat&nbsp;→&nbsp;support&nbsp;weight&nbsp;loss,&nbsp;blood&nbsp;circulation,&nbsp;and&nbsp;prevent&nbsp;edema.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Rich&nbsp;in&nbsp;anthocyanins,&nbsp;lignans,&nbsp;etc.,&nbsp;with&nbsp;antioxidant&nbsp;properties,&nbsp;neutralizing&nbsp;free&nbsp;radicals,&nbsp;slowing&nbsp;aging,&nbsp;and&nbsp;boosting&nbsp;immunity.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">High&nbsp;vitamin&nbsp;A&nbsp;content&nbsp;helps&nbsp;reduce&nbsp;eye&nbsp;fatigue&nbsp;and&nbsp;improve&nbsp;vision.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Anthocyanins&nbsp;remove&nbsp;residues&nbsp;and&nbsp;toxins&nbsp;from&nbsp;blood&nbsp;vessels,&nbsp;strengthen&nbsp;blood&nbsp;vessels,&nbsp;lower&nbsp;LDL&nbsp;cholesterol&nbsp;→&nbsp;enhance&nbsp;circulation&nbsp;and&nbsp;prevent&nbsp;chronic&nbsp;diseases&nbsp;(atherosclerosis,&nbsp;hypertension,&nbsp;lipid&nbsp;disorders,&nbsp;diabetes,&nbsp;cardiac&nbsp;arrest,&nbsp;myocardial&nbsp;infarction,&nbsp;stroke,&nbsp;etc.).</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Abundant&nbsp;vitamin&nbsp;C&nbsp;neutralizes&nbsp;free&nbsp;radicals&nbsp;and&nbsp;combats&nbsp;aging.</span></li></ul><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Hibiscus&nbsp;concentrate</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hydroxycitric&nbsp;acid&nbsp;slows&nbsp;carbohydrate&nbsp;metabolism&nbsp;→&nbsp;suppresses&nbsp;appetite;&nbsp;abundant&nbsp;potassium&nbsp;helps&nbsp;eliminate&nbsp;accumulated&nbsp;waste&nbsp;in&nbsp;the&nbsp;body.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Has&nbsp;anti-inflammatory&nbsp;and&nbsp;antibacterial&nbsp;properties,&nbsp;supporting&nbsp;enhanced&nbsp;skin&nbsp;immunity.</span></li></ul><h2></h2><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Collagen</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">One&nbsp;of&nbsp;the&nbsp;proteins&nbsp;that&nbsp;provides&nbsp;elasticity&nbsp;to&nbsp;the&nbsp;body,&nbsp;found&nbsp;in&nbsp;skin,&nbsp;bones,&nbsp;blood&nbsp;vessels…,&nbsp;playing&nbsp;a&nbsp;role&nbsp;in&nbsp;connecting&nbsp;cells.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Has&nbsp;elasticity,&nbsp;helping&nbsp;the&nbsp;skin&nbsp;stay&nbsp;firm.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Soothes&nbsp;joint&nbsp;pain.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Supports&nbsp;strong&nbsp;bones.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Maintains&nbsp;softness&nbsp;in&nbsp;blood&nbsp;vessels,&nbsp;preventing&nbsp;arteriosclerosis.</span></li></ul><p></p>', '', '', '', '2026-02-03 17:51:54', '2026-02-03 17:51:54', 94, NULL, '', ' Type: Candy| Packaging: 10 pieces x 20 g |Suggested Retail Price: 35,000 KRW |Main Ingredients: Pomegranate concentrate, seven-berry concentrate, hibiscus concentrate, collagen'),
(390, 385, 'en', 'Saponin 900', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Công dụng chính của nguyên liệu\"},{\"attributes\":{\"header\":1},\"insert\":\"\\n\"},{\"insert\":\"\\n\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Dịch cô đặc hồng sâm củ 6 năm tuổi\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ tăng cường miễn dịch\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ cải thiện mệt mỏi\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ lưu thông máu nhờ ức chế kết tập tiểu cầu\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ cải thiện trí nhớ\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ chống oxy hóa\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Dịch cô đặc rễ sâm núi nuôi cấy\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Rễ sâm núi nuôi cấy được tạo từ tế bào rễ của cây sâm núi tự nhiên 120 năm tuổi ở Hàn Quốc, được nuôi cấy vô trùng, có 99,8% vật chất di truyền giống sâm núi tự nhiên nên giữ nguyên được công dụng và đặc tính di truyền của sâm núi.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Được Cục An toàn Thực phẩm và Dược phẩm Hàn Quốc cấp phép sử dụng tên “rễ sâm núi nuôi cấy”.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Đã vượt qua bài kiểm tra độ an toàn của FDA Hoa Kỳ, nên được công nhận uy tín quốc tế.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Rễ sâm núi nuôi cấy được trồng bằng phương pháp thủy canh vô trùnh nên hoàn toàn không có dư lượng thuốc trừ sâu như các loại hồng sâm khác.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', '<h1><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Công&nbsp;dụng&nbsp;chính&nbsp;của&nbsp;nguyên&nbsp;liệu</span></h1><p></p><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Dịch&nbsp;cô&nbsp;đặc&nbsp;hồng&nbsp;sâm&nbsp;củ&nbsp;6&nbsp;năm&nbsp;tuổi</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;tăng&nbsp;cường&nbsp;miễn&nbsp;dịch</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;cải&nbsp;thiện&nbsp;mệt&nbsp;mỏi</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;lưu&nbsp;thông&nbsp;máu&nbsp;nhờ&nbsp;ức&nbsp;chế&nbsp;kết&nbsp;tập&nbsp;tiểu&nbsp;cầu</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;cải&nbsp;thiện&nbsp;trí&nbsp;nhớ</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;chống&nbsp;oxy&nbsp;hóa</span></li></ul><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Dịch&nbsp;cô&nbsp;đặc&nbsp;rễ&nbsp;sâm&nbsp;núi&nbsp;nuôi&nbsp;cấy</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Rễ&nbsp;sâm&nbsp;núi&nbsp;nuôi&nbsp;cấy&nbsp;được&nbsp;tạo&nbsp;từ&nbsp;tế&nbsp;bào&nbsp;rễ&nbsp;của&nbsp;cây&nbsp;sâm&nbsp;núi&nbsp;tự&nbsp;nhiên&nbsp;120&nbsp;năm&nbsp;tuổi&nbsp;ở&nbsp;Hàn&nbsp;Quốc,&nbsp;được&nbsp;nuôi&nbsp;cấy&nbsp;vô&nbsp;trùng,&nbsp;có&nbsp;99,8%&nbsp;vật&nbsp;chất&nbsp;di&nbsp;truyền&nbsp;giống&nbsp;sâm&nbsp;núi&nbsp;tự&nbsp;nhiên&nbsp;nên&nbsp;giữ&nbsp;nguyên&nbsp;được&nbsp;công&nbsp;dụng&nbsp;và&nbsp;đặc&nbsp;tính&nbsp;di&nbsp;truyền&nbsp;của&nbsp;sâm&nbsp;núi.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Được&nbsp;Cục&nbsp;An&nbsp;toàn&nbsp;Thực&nbsp;phẩm&nbsp;và&nbsp;Dược&nbsp;phẩm&nbsp;Hàn&nbsp;Quốc&nbsp;cấp&nbsp;phép&nbsp;sử&nbsp;dụng&nbsp;tên&nbsp;“rễ&nbsp;sâm&nbsp;núi&nbsp;nuôi&nbsp;cấy”.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Đã&nbsp;vượt&nbsp;qua&nbsp;bài&nbsp;kiểm&nbsp;tra&nbsp;độ&nbsp;an&nbsp;toàn&nbsp;của&nbsp;FDA&nbsp;Hoa&nbsp;Kỳ,&nbsp;nên&nbsp;được&nbsp;công&nbsp;nhận&nbsp;uy&nbsp;tín&nbsp;quốc&nbsp;tế.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Rễ&nbsp;sâm&nbsp;núi&nbsp;nuôi&nbsp;cấy&nbsp;được&nbsp;trồng&nbsp;bằng&nbsp;phương&nbsp;pháp&nbsp;thủy&nbsp;canh&nbsp;vô&nbsp;trùnh&nbsp;nên&nbsp;hoàn&nbsp;toàn&nbsp;không&nbsp;có&nbsp;dư&nbsp;lượng&nbsp;thuốc&nbsp;trừ&nbsp;sâu&nbsp;như&nbsp;các&nbsp;loại&nbsp;hồng&nbsp;sâm&nbsp;khác.</span></li></ul><p></p>', '', '', '', '2026-02-03 17:52:40', '2026-02-03 18:30:13', 94, 94, '', 'Loại: Đồ uống hồng sâm| Dạng đóng gói: 30 gói x 70 ml |Giá bán lẻ đề nghị: 350.000 KRW |Nguyên liệu chính: Dịch cô đặc hồng sâm củ 6 năm tuổi, dịch cô đặc rễ sâm núi nuôi cấy'),
(391, 386, 'en', 'Pretty pomegranate.', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Main use of materials\"},{\"attributes\":{\"header\":1},\"insert\":\"\\n\"},{\"insert\":\"\\n\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Pomegranate concentrated fluid\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Ellagic acid – a type of plant phytoestrogen – helps reduce menopausal symptoms in women (hot flashes, menstrual irregularities, insomnia, osteoporosis, etc.).\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Powerful antioxidant, inhibits the activity of cancer cells in the breast, skin, esophagus, colon, prostate, and pancreas.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Zinc content – an essential element for immunity – is 2.5 times higher than in kiwi.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Seven-Berry Concentrator\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Polyphenols inhibit fat absorption in the intestines, promote energy expenditure, and burn excess fat → supports weight loss, improves blood circulation, and helps prevent edema.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Rich in anthocyanins, lignans… act as antioxidants, neutralize free radicals, slow aging, and boost immunity.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"High vitamin A content helps reduce eye fatigue and improves vision.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Anthocyanins remove waste and toxins from blood vessels, strengthen vessels, lower LDL cholesterol → improve circulation, prevent chronic diseases (atherosclerosis, hypertension, lipid disorders, diabetes, cardiac arrest, myocardial infarction, stroke…).\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Abundant vitamin C neutralizes free radicals and fights aging.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Hibiscus concentrate\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hydroxycitric acid slows carbohydrate metabolism → suppresses appetite; abundant potassium helps eliminate accumulated waste in the body.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Has anti-inflammatory and antibacterial properties, supporting skin immunity.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Collagen\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"One of the proteins that provides elasticity to the body, found in skin, bones, blood vessels…, and plays a role in connecting cells.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Provides elasticity, helping the skin stay firm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Soothes joint pain.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Helps strengthen bones.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Maintains softness of blood vessels, preventing arteriosclerosis.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', '<h1><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Main&nbsp;use&nbsp;of&nbsp;materials</span></h1><p></p><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Pomegranate&nbsp;concentrated&nbsp;fluid</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Ellagic&nbsp;acid&nbsp;–&nbsp;a&nbsp;type&nbsp;of&nbsp;plant&nbsp;phytoestrogen&nbsp;–&nbsp;helps&nbsp;reduce&nbsp;menopausal&nbsp;symptoms&nbsp;in&nbsp;women&nbsp;(hot&nbsp;flashes,&nbsp;menstrual&nbsp;irregularities,&nbsp;insomnia,&nbsp;osteoporosis,&nbsp;etc.).</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Powerful&nbsp;antioxidant,&nbsp;inhibits&nbsp;the&nbsp;activity&nbsp;of&nbsp;cancer&nbsp;cells&nbsp;in&nbsp;the&nbsp;breast,&nbsp;skin,&nbsp;esophagus,&nbsp;colon,&nbsp;prostate,&nbsp;and&nbsp;pancreas.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Zinc&nbsp;content&nbsp;–&nbsp;an&nbsp;essential&nbsp;element&nbsp;for&nbsp;immunity&nbsp;–&nbsp;is&nbsp;2.5&nbsp;times&nbsp;higher&nbsp;than&nbsp;in&nbsp;kiwi.</span></li></ul><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Seven-Berry&nbsp;Concentrator</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Polyphenols&nbsp;inhibit&nbsp;fat&nbsp;absorption&nbsp;in&nbsp;the&nbsp;intestines,&nbsp;promote&nbsp;energy&nbsp;expenditure,&nbsp;and&nbsp;burn&nbsp;excess&nbsp;fat&nbsp;→&nbsp;supports&nbsp;weight&nbsp;loss,&nbsp;improves&nbsp;blood&nbsp;circulation,&nbsp;and&nbsp;helps&nbsp;prevent&nbsp;edema.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Rich&nbsp;in&nbsp;anthocyanins,&nbsp;lignans…&nbsp;act&nbsp;as&nbsp;antioxidants,&nbsp;neutralize&nbsp;free&nbsp;radicals,&nbsp;slow&nbsp;aging,&nbsp;and&nbsp;boost&nbsp;immunity.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">High&nbsp;vitamin&nbsp;A&nbsp;content&nbsp;helps&nbsp;reduce&nbsp;eye&nbsp;fatigue&nbsp;and&nbsp;improves&nbsp;vision.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Anthocyanins&nbsp;remove&nbsp;waste&nbsp;and&nbsp;toxins&nbsp;from&nbsp;blood&nbsp;vessels,&nbsp;strengthen&nbsp;vessels,&nbsp;lower&nbsp;LDL&nbsp;cholesterol&nbsp;→&nbsp;improve&nbsp;circulation,&nbsp;prevent&nbsp;chronic&nbsp;diseases&nbsp;(atherosclerosis,&nbsp;hypertension,&nbsp;lipid&nbsp;disorders,&nbsp;diabetes,&nbsp;cardiac&nbsp;arrest,&nbsp;myocardial&nbsp;infarction,&nbsp;stroke…).</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Abundant&nbsp;vitamin&nbsp;C&nbsp;neutralizes&nbsp;free&nbsp;radicals&nbsp;and&nbsp;fights&nbsp;aging.</span></li></ul><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Hibiscus&nbsp;concentrate</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hydroxycitric&nbsp;acid&nbsp;slows&nbsp;carbohydrate&nbsp;metabolism&nbsp;→&nbsp;suppresses&nbsp;appetite;&nbsp;abundant&nbsp;potassium&nbsp;helps&nbsp;eliminate&nbsp;accumulated&nbsp;waste&nbsp;in&nbsp;the&nbsp;body.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Has&nbsp;anti-inflammatory&nbsp;and&nbsp;antibacterial&nbsp;properties,&nbsp;supporting&nbsp;skin&nbsp;immunity.</span></li></ul><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Collagen</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">One&nbsp;of&nbsp;the&nbsp;proteins&nbsp;that&nbsp;provides&nbsp;elasticity&nbsp;to&nbsp;the&nbsp;body,&nbsp;found&nbsp;in&nbsp;skin,&nbsp;bones,&nbsp;blood&nbsp;vessels…,&nbsp;and&nbsp;plays&nbsp;a&nbsp;role&nbsp;in&nbsp;connecting&nbsp;cells.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Provides&nbsp;elasticity,&nbsp;helping&nbsp;the&nbsp;skin&nbsp;stay&nbsp;firm.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Soothes&nbsp;joint&nbsp;pain.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Helps&nbsp;strengthen&nbsp;bones.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Maintains&nbsp;softness&nbsp;of&nbsp;blood&nbsp;vessels,&nbsp;preventing&nbsp;arteriosclerosis.</span></li></ul><p></p>', '', '', '', '2026-02-03 17:53:42', '2026-02-03 17:53:42', 94, NULL, '', 'Type: Candy |Packaging: 10 tablets x 20 g |Suggested Retail Price: 35,000 KRW |Main Ingredients: Pomegranate concentrate, seven-berry concentrate, hibiscus concentrate, collagen'),
(392, 381, 'vn', 'Sâm chứa tâm hồn núi sâu', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"CÔNG DỤNG CHÍNH CỦA NGUYÊN LIỆU\"},{\"attributes\":{\"header\":1},\"insert\":\"\\n\"},{\"insert\":\"\\n\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Dịch cô đặc hắc sâm\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ tăng cường miễn dịch\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ cải thiện mệt mỏi\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ lưu thông máu nhờ ức chế kết tập tiểu cầu\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ cải thiện trí nhớ\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ chống oxy hóa\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ ức chế ung thư túi mật, gan,…\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Dịch cô đặc quả nhân sâm\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Quả nhân sâm: quả hiếm, chỉ nở trong khoảng 1 tuần giữa tháng 7 trên cây nhân sâm 4 năm tuổi\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Có tác dụng chống oxy hóa mạnh, loại bỏ gốc tự do có hại, ức chế gen lão hóa và kích hoạt gen chống lão hóa\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Tại Mỹ đã chứng minh được hiệu quả chống tiểu đường và chống béo phì của quả nhân sâm\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', '<h1><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">CÔNG&nbsp;DỤNG&nbsp;CHÍNH&nbsp;CỦA&nbsp;NGUYÊN&nbsp;LIỆU</span></h1><p></p><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Dịch&nbsp;cô&nbsp;đặc&nbsp;hắc&nbsp;sâm</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;tăng&nbsp;cường&nbsp;miễn&nbsp;dịch</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;cải&nbsp;thiện&nbsp;mệt&nbsp;mỏi</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;lưu&nbsp;thông&nbsp;máu&nbsp;nhờ&nbsp;ức&nbsp;chế&nbsp;kết&nbsp;tập&nbsp;tiểu&nbsp;cầu</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;cải&nbsp;thiện&nbsp;trí&nbsp;nhớ</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;chống&nbsp;oxy&nbsp;hóa</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;ức&nbsp;chế&nbsp;ung&nbsp;thư&nbsp;túi&nbsp;mật,&nbsp;gan,…</span></li></ul><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Dịch&nbsp;cô&nbsp;đặc&nbsp;quả&nbsp;nhân&nbsp;sâm</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Quả&nbsp;nhân&nbsp;sâm:&nbsp;quả&nbsp;hiếm,&nbsp;chỉ&nbsp;nở&nbsp;trong&nbsp;khoảng&nbsp;1&nbsp;tuần&nbsp;giữa&nbsp;tháng&nbsp;7&nbsp;trên&nbsp;cây&nbsp;nhân&nbsp;sâm&nbsp;4&nbsp;năm&nbsp;tuổi</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Có&nbsp;tác&nbsp;dụng&nbsp;chống&nbsp;oxy&nbsp;hóa&nbsp;mạnh,&nbsp;loại&nbsp;bỏ&nbsp;gốc&nbsp;tự&nbsp;do&nbsp;có&nbsp;hại,&nbsp;ức&nbsp;chế&nbsp;gen&nbsp;lão&nbsp;hóa&nbsp;và&nbsp;kích&nbsp;hoạt&nbsp;gen&nbsp;chống&nbsp;lão&nbsp;hóa</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Tại&nbsp;Mỹ&nbsp;đã&nbsp;chứng&nbsp;minh&nbsp;được&nbsp;hiệu&nbsp;quả&nbsp;chống&nbsp;tiểu&nbsp;đường&nbsp;và&nbsp;chống&nbsp;béo&nbsp;phì&nbsp;của&nbsp;quả&nbsp;nhân&nbsp;sâm</span></li></ul><p></p>', '', '', '', '2026-02-03 18:26:10', '2026-02-03 18:26:10', 94, NULL, '', ' Loại: Đồ uống hồng sâm| Dạng đóng gói: 30 gói x 20 ml |Giá bán lẻ đề nghị: 390.000 KRW |Nguyên liệu chính: Dịch cô đặc hắc sâm, dịch cô đặc quả nhân sâm'),
(393, 382, 'vn', 'Trà Ra-on', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"CÔNG DỤNG CHÍNH CỦA NGUYÊN LIỆU\"},{\"attributes\":{\"header\":1},\"insert\":\"\\n\"},{\"insert\":\"\\n\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Dịch cô đặc hắc sâm\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ tăng cường miễn dịch\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ cải thiện mệt mỏi\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ lưu thông máu nhờ ức chế kết tập tiểu cầu\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ cải thiện trí nhớ\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ chống oxy hóa\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ ức chế ung thư túi mật, gan,…\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Dịch cô đặc quả nhân sâm\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Quả nhân sâm: quả hiếm, chỉ nở trong khoảng 1 tuần giữa tháng 7 trên cây nhân sâm 4 năm tuổi\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Có tác dụng chống oxy hóa mạnh, loại bỏ gốc tự do có hại, ức chế gen lão hóa và kích hoạt gen chống lão hóa\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Tại Mỹ đã chứng minh được hiệu quả chống tiểu đường và chống béo phì của quả nhân sâm\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', '<h1><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">CÔNG&nbsp;DỤNG&nbsp;CHÍNH&nbsp;CỦA&nbsp;NGUYÊN&nbsp;LIỆU</span></h1><p></p><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Dịch&nbsp;cô&nbsp;đặc&nbsp;hắc&nbsp;sâm</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;tăng&nbsp;cường&nbsp;miễn&nbsp;dịch</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;cải&nbsp;thiện&nbsp;mệt&nbsp;mỏi</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;lưu&nbsp;thông&nbsp;máu&nbsp;nhờ&nbsp;ức&nbsp;chế&nbsp;kết&nbsp;tập&nbsp;tiểu&nbsp;cầu</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;cải&nbsp;thiện&nbsp;trí&nbsp;nhớ</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;chống&nbsp;oxy&nbsp;hóa</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;ức&nbsp;chế&nbsp;ung&nbsp;thư&nbsp;túi&nbsp;mật,&nbsp;gan,…</span></li></ul><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Dịch&nbsp;cô&nbsp;đặc&nbsp;quả&nbsp;nhân&nbsp;sâm</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Quả&nbsp;nhân&nbsp;sâm:&nbsp;quả&nbsp;hiếm,&nbsp;chỉ&nbsp;nở&nbsp;trong&nbsp;khoảng&nbsp;1&nbsp;tuần&nbsp;giữa&nbsp;tháng&nbsp;7&nbsp;trên&nbsp;cây&nbsp;nhân&nbsp;sâm&nbsp;4&nbsp;năm&nbsp;tuổi</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Có&nbsp;tác&nbsp;dụng&nbsp;chống&nbsp;oxy&nbsp;hóa&nbsp;mạnh,&nbsp;loại&nbsp;bỏ&nbsp;gốc&nbsp;tự&nbsp;do&nbsp;có&nbsp;hại,&nbsp;ức&nbsp;chế&nbsp;gen&nbsp;lão&nbsp;hóa&nbsp;và&nbsp;kích&nbsp;hoạt&nbsp;gen&nbsp;chống&nbsp;lão&nbsp;hóa</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Tại&nbsp;Mỹ&nbsp;đã&nbsp;chứng&nbsp;minh&nbsp;được&nbsp;hiệu&nbsp;quả&nbsp;chống&nbsp;tiểu&nbsp;đường&nbsp;và&nbsp;chống&nbsp;béo&nbsp;phì&nbsp;của&nbsp;quả&nbsp;nhân&nbsp;sâm</span></li></ul><p></p>', '', '', '', '2026-02-03 18:26:57', '2026-02-03 18:26:57', 94, NULL, '', 'Loại: Trà dạng rắn |Dạng đóng gói: 60 gói x 10 g |Giá bán lẻ đề nghị: 156.000 KRW |Nguyên liệu chính: Bột cô đặc hỗn hợp thực vật (cần tây, bí đỏ, đậu đỏ), xylitol'),
(394, 383, 'vn', 'Trà Bó-ram', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"CÔNG DỤNG CHÍNH CỦA NGUYÊN LIỆU\"},{\"attributes\":{\"header\":1},\"insert\":\"\\n\"},{\"insert\":\"\\n\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Dịch cô đặc hắc sâm\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ tăng cường miễn dịch\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ cải thiện mệt mỏi\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ lưu thông máu nhờ ức chế kết tập tiểu cầu\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ cải thiện trí nhớ\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ chống oxy hóa\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hỗ trợ ức chế ung thư túi mật, gan,…\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Dịch cô đặc quả nhân sâm\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Quả nhân sâm: quả hiếm, chỉ nở trong khoảng 1 tuần giữa tháng 7 trên cây nhân sâm 4 năm tuổi\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Có tác dụng chống oxy hóa mạnh, loại bỏ gốc tự do có hại, ức chế gen lão hóa và kích hoạt gen chống lão hóa\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Tại Mỹ đã chứng minh được hiệu quả chống tiểu đường và chống béo phì của quả nhân sâm\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', '<h1><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">CÔNG&nbsp;DỤNG&nbsp;CHÍNH&nbsp;CỦA&nbsp;NGUYÊN&nbsp;LIỆU</span></h1><p></p><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Dịch&nbsp;cô&nbsp;đặc&nbsp;hắc&nbsp;sâm</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;tăng&nbsp;cường&nbsp;miễn&nbsp;dịch</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;cải&nbsp;thiện&nbsp;mệt&nbsp;mỏi</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;lưu&nbsp;thông&nbsp;máu&nbsp;nhờ&nbsp;ức&nbsp;chế&nbsp;kết&nbsp;tập&nbsp;tiểu&nbsp;cầu</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;cải&nbsp;thiện&nbsp;trí&nbsp;nhớ</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;chống&nbsp;oxy&nbsp;hóa</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hỗ&nbsp;trợ&nbsp;ức&nbsp;chế&nbsp;ung&nbsp;thư&nbsp;túi&nbsp;mật,&nbsp;gan,…</span></li></ul><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Dịch&nbsp;cô&nbsp;đặc&nbsp;quả&nbsp;nhân&nbsp;sâm</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Quả&nbsp;nhân&nbsp;sâm:&nbsp;quả&nbsp;hiếm,&nbsp;chỉ&nbsp;nở&nbsp;trong&nbsp;khoảng&nbsp;1&nbsp;tuần&nbsp;giữa&nbsp;tháng&nbsp;7&nbsp;trên&nbsp;cây&nbsp;nhân&nbsp;sâm&nbsp;4&nbsp;năm&nbsp;tuổi</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Có&nbsp;tác&nbsp;dụng&nbsp;chống&nbsp;oxy&nbsp;hóa&nbsp;mạnh,&nbsp;loại&nbsp;bỏ&nbsp;gốc&nbsp;tự&nbsp;do&nbsp;có&nbsp;hại,&nbsp;ức&nbsp;chế&nbsp;gen&nbsp;lão&nbsp;hóa&nbsp;và&nbsp;kích&nbsp;hoạt&nbsp;gen&nbsp;chống&nbsp;lão&nbsp;hóa</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Tại&nbsp;Mỹ&nbsp;đã&nbsp;chứng&nbsp;minh&nbsp;được&nbsp;hiệu&nbsp;quả&nbsp;chống&nbsp;tiểu&nbsp;đường&nbsp;và&nbsp;chống&nbsp;béo&nbsp;phì&nbsp;của&nbsp;quả&nbsp;nhân&nbsp;sâm</span></li></ul><p></p>', '', '', '', '2026-02-03 18:28:11', '2026-02-03 18:28:11', 94, NULL, '', ' Loại: Đồ uống hồng sâm |Dạng đóng gói: 30 gói x 20 ml |Giá bán lẻ đề nghị: 390.000 KRW| Nguyên liệu chính: Dịch cô đặc hắc sâm, dịch cô đặc quả nhân sâm'),
(395, 384, 'vn', 'Na-Hong-sam', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Công dụng chính của nguyên liệu\"},{\"attributes\":{\"header\":1},\"insert\":\"\\n\"},{\"insert\":\"\\n\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Dịch cô đặc lựu\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Ellagic acid – một loại phytoestrogen thực vật – giúp giảm các triệu chứng tiền mãn kinh ở phụ nữ (bốc hỏa, rối loạn kinh nguyệt, mất ngủ, loãng xương…).\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Chống oxy hóa mạnh, ức chế hoạt động của tế bào ung thư ở vú, da, thực quản, ruột kết, tuyến tiền liệt và tụy.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hàm lượng kẽm – yếu tố thiết yếu cho miễn dịch – cao gấp 2,5 lần kiwi.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Dịch cô đặc Seven-Berry\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Polyphenol ức chế hấp thu mỡ trong ruột, thúc đẩy tiêu hao năng lượng, đốt cháy mỡ thừa → hỗ trợ giảm cân, lưu thông máu và phòng chống phù nề.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Giàu anthocyanin, lignan… chống oxy hóa, trung hòa gốc tự do, làm chậm lão hóa, tăng miễn dịch.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Hàm lượng vitamin A cao giúp giảm mỏi mắt và cải thiện thị lực.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Anthocyanin loại bỏ chất cặn và độc tố trong mạch máu, làm mạch máu chắc khỏe, hạ LDL-máu → tăng tuần hoàn, phòng ngừa bệnh mạn tính (xơ vữa động mạch, tăng huyết áp, rối loạn lipid máu, đái tháo đường, ngừng tim, nhồi máu cơ tim, đột quỵ…).\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Vitamin C dồi dào trung hòa gốc tự do, chống lão hóa.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Dịch cô đặc hibiscus\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Axit hydroxycitric làm chậm chuyển hóa carbohydrate → ức chế cảm giác thèm ăn; lượng kali dồi dào giúp đào thải chất cặn tích tụ trong cơ thể.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Có tính chống viêm và kháng khuẩn, hỗ trợ tăng cường miễn dịch da.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#05517e\"},\"insert\":\"Collagen\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Là một trong những protein tạo độ đàn hồi cho cơ thể, có trong da, xương, mạch máu…, đóng vai trò kết nối tế bào.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Mang tính đàn hồi, giúp da săn chắc.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Làm dịu đau khớp.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Giúp xương chắc khỏe.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#2f3640\"},\"insert\":\"Giữ độ mềm mại cho mạch máu, ngăn ngừa xơ vữa động mạch.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', '<h1><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Công&nbsp;dụng&nbsp;chính&nbsp;của&nbsp;nguyên&nbsp;liệu</span></h1><p></p><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Dịch&nbsp;cô&nbsp;đặc&nbsp;lựu</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Ellagic&nbsp;acid&nbsp;–&nbsp;một&nbsp;loại&nbsp;phytoestrogen&nbsp;thực&nbsp;vật&nbsp;–&nbsp;giúp&nbsp;giảm&nbsp;các&nbsp;triệu&nbsp;chứng&nbsp;tiền&nbsp;mãn&nbsp;kinh&nbsp;ở&nbsp;phụ&nbsp;nữ&nbsp;(bốc&nbsp;hỏa,&nbsp;rối&nbsp;loạn&nbsp;kinh&nbsp;nguyệt,&nbsp;mất&nbsp;ngủ,&nbsp;loãng&nbsp;xương…).</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Chống&nbsp;oxy&nbsp;hóa&nbsp;mạnh,&nbsp;ức&nbsp;chế&nbsp;hoạt&nbsp;động&nbsp;của&nbsp;tế&nbsp;bào&nbsp;ung&nbsp;thư&nbsp;ở&nbsp;vú,&nbsp;da,&nbsp;thực&nbsp;quản,&nbsp;ruột&nbsp;kết,&nbsp;tuyến&nbsp;tiền&nbsp;liệt&nbsp;và&nbsp;tụy.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hàm&nbsp;lượng&nbsp;kẽm&nbsp;–&nbsp;yếu&nbsp;tố&nbsp;thiết&nbsp;yếu&nbsp;cho&nbsp;miễn&nbsp;dịch&nbsp;–&nbsp;cao&nbsp;gấp&nbsp;2,5&nbsp;lần&nbsp;kiwi.</span></li></ul><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Dịch&nbsp;cô&nbsp;đặc&nbsp;Seven-Berry</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Polyphenol&nbsp;ức&nbsp;chế&nbsp;hấp&nbsp;thu&nbsp;mỡ&nbsp;trong&nbsp;ruột,&nbsp;thúc&nbsp;đẩy&nbsp;tiêu&nbsp;hao&nbsp;năng&nbsp;lượng,&nbsp;đốt&nbsp;cháy&nbsp;mỡ&nbsp;thừa&nbsp;→&nbsp;hỗ&nbsp;trợ&nbsp;giảm&nbsp;cân,&nbsp;lưu&nbsp;thông&nbsp;máu&nbsp;và&nbsp;phòng&nbsp;chống&nbsp;phù&nbsp;nề.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Giàu&nbsp;anthocyanin,&nbsp;lignan…&nbsp;chống&nbsp;oxy&nbsp;hóa,&nbsp;trung&nbsp;hòa&nbsp;gốc&nbsp;tự&nbsp;do,&nbsp;làm&nbsp;chậm&nbsp;lão&nbsp;hóa,&nbsp;tăng&nbsp;miễn&nbsp;dịch.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Hàm&nbsp;lượng&nbsp;vitamin&nbsp;A&nbsp;cao&nbsp;giúp&nbsp;giảm&nbsp;mỏi&nbsp;mắt&nbsp;và&nbsp;cải&nbsp;thiện&nbsp;thị&nbsp;lực.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Anthocyanin&nbsp;loại&nbsp;bỏ&nbsp;chất&nbsp;cặn&nbsp;và&nbsp;độc&nbsp;tố&nbsp;trong&nbsp;mạch&nbsp;máu,&nbsp;làm&nbsp;mạch&nbsp;máu&nbsp;chắc&nbsp;khỏe,&nbsp;hạ&nbsp;LDL-máu&nbsp;→&nbsp;tăng&nbsp;tuần&nbsp;hoàn,&nbsp;phòng&nbsp;ngừa&nbsp;bệnh&nbsp;mạn&nbsp;tính&nbsp;(xơ&nbsp;vữa&nbsp;động&nbsp;mạch,&nbsp;tăng&nbsp;huyết&nbsp;áp,&nbsp;rối&nbsp;loạn&nbsp;lipid&nbsp;máu,&nbsp;đái&nbsp;tháo&nbsp;đường,&nbsp;ngừng&nbsp;tim,&nbsp;nhồi&nbsp;máu&nbsp;cơ&nbsp;tim,&nbsp;đột&nbsp;quỵ…).</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Vitamin&nbsp;C&nbsp;dồi&nbsp;dào&nbsp;trung&nbsp;hòa&nbsp;gốc&nbsp;tự&nbsp;do,&nbsp;chống&nbsp;lão&nbsp;hóa.</span></li></ul><h2></h2><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Dịch&nbsp;cô&nbsp;đặc&nbsp;hibiscus</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Axit&nbsp;hydroxycitric&nbsp;làm&nbsp;chậm&nbsp;chuyển&nbsp;hóa&nbsp;carbohydrate&nbsp;→&nbsp;ức&nbsp;chế&nbsp;cảm&nbsp;giác&nbsp;thèm&nbsp;ăn;&nbsp;lượng&nbsp;kali&nbsp;dồi&nbsp;dào&nbsp;giúp&nbsp;đào&nbsp;thải&nbsp;chất&nbsp;cặn&nbsp;tích&nbsp;tụ&nbsp;trong&nbsp;cơ&nbsp;thể.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Có&nbsp;tính&nbsp;chống&nbsp;viêm&nbsp;và&nbsp;kháng&nbsp;khuẩn,&nbsp;hỗ&nbsp;trợ&nbsp;tăng&nbsp;cường&nbsp;miễn&nbsp;dịch&nbsp;da.</span></li></ul><p></p><h2><span style=\"background-color: rgb(255, 255, 255); color: rgb(5, 81, 126);\">Collagen</span></h2><ul><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Là&nbsp;một&nbsp;trong&nbsp;những&nbsp;protein&nbsp;tạo&nbsp;độ&nbsp;đàn&nbsp;hồi&nbsp;cho&nbsp;cơ&nbsp;thể,&nbsp;có&nbsp;trong&nbsp;da,&nbsp;xương,&nbsp;mạch&nbsp;máu…,&nbsp;đóng&nbsp;vai&nbsp;trò&nbsp;kết&nbsp;nối&nbsp;tế&nbsp;bào.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Mang&nbsp;tính&nbsp;đàn&nbsp;hồi,&nbsp;giúp&nbsp;da&nbsp;săn&nbsp;chắc.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Làm&nbsp;dịu&nbsp;đau&nbsp;khớp.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Giúp&nbsp;xương&nbsp;chắc&nbsp;khỏe.</span></li><li><span style=\"background-color: rgb(255, 255, 255); color: rgb(47, 54, 64);\">Giữ&nbsp;độ&nbsp;mềm&nbsp;mại&nbsp;cho&nbsp;mạch&nbsp;máu,&nbsp;ngăn&nbsp;ngừa&nbsp;xơ&nbsp;vữa&nbsp;động&nbsp;mạch.</span></li></ul><p></p>', '', '', '', '2026-02-03 18:29:24', '2026-02-03 18:29:24', 94, NULL, '', 'Loại: Kẹo |Dạng đóng gói: 10 viên x 20 g| Giá bán lẻ đề nghị: 35.000 KRW| Nguyên liệu chính: Dịch cô đặc lựu, dịch cô đặc seven-berry, dịch cô đặc hibiscus, collagen'),
(396, 388, 'ko', '중국 공증서류', NULL, NULL, NULL, NULL, NULL, '2026-02-25 10:19:38', '2026-02-25 10:20:10', 94, 94, '중국 서류는 아포스티유로 정리가능합니다. ', '중국 서류도 레드트랜스가  전문적으로 처리가능합니다. '),
(397, 389, 'ko', '중국 취업서류', NULL, NULL, NULL, NULL, NULL, '2026-02-25 10:22:03', '2026-02-25 10:22:03', 94, NULL, '중국 취업비자 발급에 필요한 서류', '중국 취업비자 발급에 필요한 서류를 위한 아포스티유 서비스를  제공합니다. '),
(398, 390, 'ko', '베트남어번역공증', NULL, NULL, NULL, NULL, NULL, '2026-02-25 10:28:37', '2026-02-25 10:28:37', 94, NULL, '베트남 서류 통과 번역공증이 결정합니다', '베트남 입국·취업·유학·비즈니스를  준비할 때 가장 많이 실수하는 부분이  바로 번역 공증입니다. '),
(399, 391, 'ko', '베트남어 번역', NULL, NULL, NULL, NULL, NULL, '2026-02-25 10:32:49', '2026-02-25 10:32:49', 94, NULL, '혼자 준비하시기 어렵나요?', '실수 없이 빠르게 끝내려면 전문가와 시작하는 것이 가장 안전합니다. ');
INSERT INTO `articles_lang` (`id`, `article_id`, `lang`, `title`, `content_delta`, `content_html`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`, `created_by`, `updated_by`, `subject`, `description`) VALUES
(400, 392, 'ko', '베트남 위생허가 신청절차', NULL, NULL, NULL, NULL, NULL, '2026-02-25 10:33:47', '2026-02-25 10:33:47', 94, NULL, '화장품 수출 필수 절차', '베트남에 식품·화장품을 수출하려면 모든 서류가 베트남어 번역 ,공증 , 대사관 영사확인을 거쳐야 합니다.'),
(401, 393, 'ko', '베트남 경력 증명서 발급', NULL, NULL, NULL, NULL, NULL, '2026-02-25 10:34:43', '2026-02-25 10:34:43', 94, NULL, '워크퍼밋에 꼭 필요합니다. ', '베트남은 외국인 근로자에게 직무 관련 경력 기준을 요구하며, 특히 전문직·중간관리직의 경우  2~5년 이상의 경력 증빙이  필수입니다.'),
(402, 394, 'ko', ' 등록된 상표를 베트남 내에서 어떻게 활용할 수 있나요?', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#1f1f1f\"},\"insert\":\"상표는 법적 보호 외에도 마케팅 및 브랜딩 전략의 핵심 요소로 활용되며, 침해 시 법적 대응 근거로 사용할 수 있습니다. \"},{\"insert\":\"\\n\"}]}', '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(31, 31, 31);\">상표는&nbsp;법적&nbsp;보호&nbsp;외에도&nbsp;마케팅&nbsp;및&nbsp;브랜딩&nbsp;전략의&nbsp;핵심&nbsp;요소로&nbsp;활용되며,&nbsp;침해&nbsp;시&nbsp;법적&nbsp;대응&nbsp;근거로&nbsp;사용할&nbsp;수&nbsp;있습니다.&nbsp;</span></p>', NULL, NULL, NULL, '2026-02-25 12:04:33', '2026-02-25 12:04:33', 94, NULL, NULL, NULL),
(403, 395, 'ko', '상표등록이 승인되면 얼마나 보호받을 수 있나요?', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#1f1f1f\"},\"insert\":\"상표등록이 완료되면 10년간 보호되며, 이후 갱신을 통해 연장할 수 있습니다.\"},{\"insert\":\"\\n\"}]}', '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(31, 31, 31);\">상표등록이&nbsp;완료되면&nbsp;10년간&nbsp;보호되며,&nbsp;이후&nbsp;갱신을&nbsp;통해&nbsp;연장할&nbsp;수&nbsp;있습니다.</span></p>', NULL, NULL, NULL, '2026-02-25 12:05:17', '2026-02-25 12:05:17', 94, NULL, NULL, NULL),
(404, 396, 'ko', '상표등록 비용은 어떻게 산정되나요?', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#1f1f1f\"},\"insert\":\"비용은 상표의 분류(상품/서비스 카테고리) 수에 따라 달라지며, 정부 수수료와 대행 서비스 비용이 포함됩니다.\"},{\"insert\":\"\\n\"}]}', '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(31, 31, 31);\">비용은&nbsp;상표의&nbsp;분류(상품/서비스&nbsp;카테고리)&nbsp;수에&nbsp;따라&nbsp;달라지며,&nbsp;정부&nbsp;수수료와&nbsp;대행&nbsp;서비스&nbsp;비용이&nbsp;포함됩니다.</span></p>', NULL, NULL, NULL, '2026-02-25 12:05:57', '2026-02-25 12:05:57', 94, NULL, NULL, NULL),
(405, 397, 'ko', '외국 회사도 직접 베트남에서 상표를 등록할 수 있나요?', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#1f1f1f\"},\"insert\":\"외국 회사는 베트남 현지 대리인을 통해서만 상표등록을 신청할 수 있습니다. 레드트랜스는 이 과정을 대행합니다.\"},{\"insert\":\"\\n\"}]}', '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(31, 31, 31);\">외국&nbsp;회사는&nbsp;베트남&nbsp;현지&nbsp;대리인을&nbsp;통해서만&nbsp;상표등록을&nbsp;신청할&nbsp;수&nbsp;있습니다.&nbsp;레드트랜스는&nbsp;이&nbsp;과정을&nbsp;대행합니다.</span></p>', NULL, NULL, NULL, '2026-02-25 12:06:23', '2026-02-25 12:06:23', 94, NULL, NULL, NULL),
(406, 398, 'ko', '등록 가능한 상표의 기준은 무엇인가요?', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#1f1f1f\"},\"insert\":\"고유하고 식별 가능한 이름, 로고, 색상 조합 등이 등록 가능합니다. 단, 일반적인 용어나 공공 기호는 등록이 불가합니다.\"},{\"insert\":\"\\n\"}]}', '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(31, 31, 31);\">고유하고&nbsp;식별&nbsp;가능한&nbsp;이름,&nbsp;로고,&nbsp;색상&nbsp;조합&nbsp;등이&nbsp;등록&nbsp;가능합니다.&nbsp;단,&nbsp;일반적인&nbsp;용어나&nbsp;공공&nbsp;기호는&nbsp;등록이&nbsp;불가합니다.</span></p>', NULL, NULL, NULL, '2026-02-25 12:06:49', '2026-02-25 12:06:49', 94, NULL, NULL, NULL),
(407, 399, 'ko', '등록하려는 상표가 이미 등록된 상표와 유사하면 어떻게 되나요?', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#1f1f1f\"},\"insert\":\"유사하거나 동일한 상표는 등록이 거절될 수 있으며, 레드트랜스에서는 사전 조사를 통해 등록 가능성을 평가하고 대안을 제시합니다.\"},{\"insert\":\"\\n\"}]}', '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(31, 31, 31);\">유사하거나&nbsp;동일한&nbsp;상표는&nbsp;등록이&nbsp;거절될&nbsp;수&nbsp;있으며,&nbsp;레드트랜스에서는&nbsp;사전&nbsp;조사를&nbsp;통해&nbsp;등록&nbsp;가능성을&nbsp;평가하고&nbsp;대안을&nbsp;제시합니다.</span></p>', NULL, NULL, NULL, '2026-02-25 12:07:22', '2026-02-25 12:07:22', 94, NULL, NULL, NULL),
(408, 400, 'ko', '위생허가 등록은 얼마나 걸리나요?', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#1f1f1f\"},\"insert\":\"일반적으로 신청 후 2개월 정도 소요되며, 서류가 완벽하지 않으면 추가 시간이 걸릴 수 있습니다.\"},{\"insert\":\"\\n\"}]}', '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(31, 31, 31);\">일반적으로&nbsp;신청&nbsp;후&nbsp;2개월&nbsp;정도&nbsp;소요되며,&nbsp;서류가&nbsp;완벽하지&nbsp;않으면&nbsp;추가&nbsp;시간이&nbsp;걸릴&nbsp;수&nbsp;있습니다.</span></p>', NULL, NULL, NULL, '2026-02-25 12:07:48', '2026-02-25 12:07:48', 94, NULL, NULL, NULL),
(409, 401, 'ko', '상표등록 절차는 얼마나 걸리나요?', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#1f1f1f\"},\"insert\":\"일반적으로 등록까지 약 12~18개월이 소요되며, 서류 보완이나 이의 제기 등으로 기간이 연장될 수 있습니다.\"},{\"insert\":\"\\n\"}]}', '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(31, 31, 31);\">일반적으로&nbsp;등록까지&nbsp;약&nbsp;12~18개월이&nbsp;소요되며,&nbsp;서류&nbsp;보완이나&nbsp;이의&nbsp;제기&nbsp;등으로&nbsp;기간이&nbsp;연장될&nbsp;수&nbsp;있습니다.</span></p>', NULL, NULL, NULL, '2026-02-25 12:08:12', '2026-02-25 12:08:12', 94, NULL, NULL, NULL),
(410, 402, 'ko', '베트남에서 상표등록이 왜 필요한가요?', '{\"ops\":[{\"attributes\":{\"background\":\"#ffffff\",\"color\":\"#1f1f1f\"},\"insert\":\"상표등록은 브랜드를 보호하고, 유사 상표 사용으로 인한 분쟁을 방지하며, 독점적 권리를 확보하기 위해 필수적입니다.\"},{\"insert\":\"\\n\"}]}', '<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(31, 31, 31);\">상표등록은 브랜드를 보호하고, 유사 상표 사용으로 인한 분쟁을 방지하며, 독점적 권리를 확보하기 위해 필수적입니다.</span></p>', NULL, NULL, NULL, '2026-02-25 12:08:42', '2026-02-26 12:35:50', 94, 94, NULL, NULL),
(411, 403, 'ko', 'Story One', '{\"ops\":[{\"insert\":\"11년 차의 한 미용용품 전문몰은 4개의 각기 다른 자사몰을 직접 운영하고 있었어요. 4개의 쇼핑몰 모두 유사한 품목을 다루지만, 타겟 고객과 브랜딩을 달리하여 시장을 공략하는 \'멀티 브랜드\' 전략을 사용했죠.\\n\\n이러한 전략은 더 넓은 고객층을 확보할 수 있다는 장점이 있지만, 운영의 복잡성은 4배가 돼요. 4개의 관리자 페이지, 4배의 상품 관리, 분리된 고객 데이터는 대표 한 명이 감당하기에 상당한 부담이었어요.\\n\\n이 구조적인 복잡성을 해결하기 위해 4개 몰 모두에 카페24 PRO 운영대행을 도입한 이 전문몰은, 서비스 시작 후 단기간에 전문가들의 통합 관리를 통해 다음과 같은 의미 있는 데이터를 만들어냈어요.\\n\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"✔ 전체 방문자 수 : PRO 사용 전 대비 43% 증가\"},{\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"✔ 재방문 고객 수 : PRO 사용 전 대비 2.1배 폭증\"},{\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"✔ 상품 상세 페이지 조회 수 : PRO 사용 전 대비 52% 급증\"},{\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"✔ 신규 상품 등록 : 2달간 134건 진행\"},{\"insert\":\"\\n(미용 쇼핑몰 M사의 2025년 PRO 사용 성과 데이터)\\n\\n어떻게 이런 성과가 가능했을까요? 그 해답은 이 기업이 겪고 있던 \'다중몰 운영의 비효율\'을 카페24의 전문가 팀이 운영하며 해결한 데 있어요.\\n가장 많은 시간을 뺏는 \'상품 관리\', 전문가가 어떻게 대행할까?\"},{\"attributes\":{\"header\":3},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"[데이터]\"},{\"attributes\":{\"header\":3},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"신규 상품 등록:\"},{\"insert\":\" 두 달간 134건\\n\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"[설명]\"},{\"attributes\":{\"header\":3},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"4개의 자사몰은 곧 4배의 상품 관리 업무를 의미해요. \"},{\"insert\":\"하나의 신제품을 등록하려면 4개의 관리자 페이지에 각각 접속해 동일한 작업을 4번 반복해야 하죠. 가격, 재고, 이미지가 바뀔 때마다 이 비효율적인 과정이 되풀이되면서 대표의 시간은 끊임없이 소모돼요. 이 과정에서 발생하는 작은 실수 하나가 재고 불일치나 판매가 오류로 이어져 고객의 신뢰를 잃게 만들 수도 있어요. 대표의 시간은 이렇게 끝없는 반복과 수정 작업에 소모되고, 정작 더 중요한 브랜드 전략을 고민할 기회는 사라져요.\\n\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"[카페24 전문가의 솔루션]\"},{\"attributes\":{\"header\":3},\"insert\":\"\\n\"},{\"insert\":\"이제 대표님은 \"},{\"attributes\":{\"bold\":true},\"insert\":\"카페24 PRO에 \'상품 등록\'을 요청\"},{\"insert\":\"하기만 하면 돼요. 한 번의 요청으로 4개 몰 전체의 상품이 등록, 수정되는 것은 물론, \"},{\"attributes\":{\"bold\":true},\"insert\":\"카페24 PRO가 직접\"},{\"insert\":\" 판매 데이터를 분석해 \'BEST\' 카테고리를 만들고, 구매 전환에 유리한 상품 진열까지 최적화해주죠. 대표는 상품 기획에만 집중할 수 있게 되는 거예요.\\n\"}]}', '<p>11년&nbsp;차의&nbsp;한&nbsp;미용용품&nbsp;전문몰은&nbsp;4개의&nbsp;각기&nbsp;다른&nbsp;자사몰을&nbsp;직접&nbsp;운영하고&nbsp;있었어요.&nbsp;4개의&nbsp;쇼핑몰&nbsp;모두&nbsp;유사한&nbsp;품목을&nbsp;다루지만,&nbsp;타겟&nbsp;고객과&nbsp;브랜딩을&nbsp;달리하여&nbsp;시장을&nbsp;공략하는&nbsp;&#39;멀티&nbsp;브랜드&#39;&nbsp;전략을&nbsp;사용했죠.</p><p></p><p>이러한&nbsp;전략은&nbsp;더&nbsp;넓은&nbsp;고객층을&nbsp;확보할&nbsp;수&nbsp;있다는&nbsp;장점이&nbsp;있지만,&nbsp;운영의&nbsp;복잡성은&nbsp;4배가&nbsp;돼요.&nbsp;4개의&nbsp;관리자&nbsp;페이지,&nbsp;4배의&nbsp;상품&nbsp;관리,&nbsp;분리된&nbsp;고객&nbsp;데이터는&nbsp;대표&nbsp;한&nbsp;명이&nbsp;감당하기에&nbsp;상당한&nbsp;부담이었어요.</p><p></p><p>이&nbsp;구조적인&nbsp;복잡성을&nbsp;해결하기&nbsp;위해&nbsp;4개&nbsp;몰&nbsp;모두에&nbsp;카페24&nbsp;PRO&nbsp;운영대행을&nbsp;도입한&nbsp;이&nbsp;전문몰은,&nbsp;서비스&nbsp;시작&nbsp;후&nbsp;단기간에&nbsp;전문가들의&nbsp;통합&nbsp;관리를&nbsp;통해&nbsp;다음과&nbsp;같은&nbsp;의미&nbsp;있는&nbsp;데이터를&nbsp;만들어냈어요.</p><p></p><p><strong>✔&nbsp;전체&nbsp;방문자&nbsp;수&nbsp;:&nbsp;PRO&nbsp;사용&nbsp;전&nbsp;대비&nbsp;43%&nbsp;증가</strong></p><p><strong>✔&nbsp;재방문&nbsp;고객&nbsp;수&nbsp;:&nbsp;PRO&nbsp;사용&nbsp;전&nbsp;대비&nbsp;2.1배&nbsp;폭증</strong></p><p><strong>✔&nbsp;상품&nbsp;상세&nbsp;페이지&nbsp;조회&nbsp;수&nbsp;:&nbsp;PRO&nbsp;사용&nbsp;전&nbsp;대비&nbsp;52%&nbsp;급증</strong></p><p><strong>✔&nbsp;신규&nbsp;상품&nbsp;등록&nbsp;:&nbsp;2달간&nbsp;134건&nbsp;진행</strong></p><p>(미용&nbsp;쇼핑몰&nbsp;M사의&nbsp;2025년&nbsp;PRO&nbsp;사용&nbsp;성과&nbsp;데이터)</p><p></p><p>어떻게&nbsp;이런&nbsp;성과가&nbsp;가능했을까요?&nbsp;그&nbsp;해답은&nbsp;이&nbsp;기업이&nbsp;겪고&nbsp;있던&nbsp;&#39;다중몰&nbsp;운영의&nbsp;비효율&#39;을&nbsp;카페24의&nbsp;전문가&nbsp;팀이&nbsp;운영하며&nbsp;해결한&nbsp;데&nbsp;있어요.</p><h3>가장&nbsp;많은&nbsp;시간을&nbsp;뺏는&nbsp;&#39;상품&nbsp;관리&#39;,&nbsp;전문가가&nbsp;어떻게&nbsp;대행할까?</h3><h3><strong>[데이터]</strong></h3><p><strong>신규&nbsp;상품&nbsp;등록:</strong>&nbsp;두&nbsp;달간&nbsp;134건</p><p></p><h3><strong>[설명]</strong></h3><p><strong>4개의&nbsp;자사몰은&nbsp;곧&nbsp;4배의&nbsp;상품&nbsp;관리&nbsp;업무를&nbsp;의미해요.&nbsp;</strong>하나의&nbsp;신제품을&nbsp;등록하려면&nbsp;4개의&nbsp;관리자&nbsp;페이지에&nbsp;각각&nbsp;접속해&nbsp;동일한&nbsp;작업을&nbsp;4번&nbsp;반복해야&nbsp;하죠.&nbsp;가격,&nbsp;재고,&nbsp;이미지가&nbsp;바뀔&nbsp;때마다&nbsp;이&nbsp;비효율적인&nbsp;과정이&nbsp;되풀이되면서&nbsp;대표의&nbsp;시간은&nbsp;끊임없이&nbsp;소모돼요.&nbsp;이&nbsp;과정에서&nbsp;발생하는&nbsp;작은&nbsp;실수&nbsp;하나가&nbsp;재고&nbsp;불일치나&nbsp;판매가&nbsp;오류로&nbsp;이어져&nbsp;고객의&nbsp;신뢰를&nbsp;잃게&nbsp;만들&nbsp;수도&nbsp;있어요.&nbsp;대표의&nbsp;시간은&nbsp;이렇게&nbsp;끝없는&nbsp;반복과&nbsp;수정&nbsp;작업에&nbsp;소모되고,&nbsp;정작&nbsp;더&nbsp;중요한&nbsp;브랜드&nbsp;전략을&nbsp;고민할&nbsp;기회는&nbsp;사라져요.</p><p></p><h3><strong>[카페24&nbsp;전문가의&nbsp;솔루션]</strong></h3><p>이제&nbsp;대표님은&nbsp;<strong>카페24&nbsp;PRO에&nbsp;&#39;상품&nbsp;등록&#39;을&nbsp;요청</strong>하기만&nbsp;하면&nbsp;돼요.&nbsp;한&nbsp;번의&nbsp;요청으로&nbsp;4개&nbsp;몰&nbsp;전체의&nbsp;상품이&nbsp;등록,&nbsp;수정되는&nbsp;것은&nbsp;물론,&nbsp;<strong>카페24&nbsp;PRO가&nbsp;직접</strong>&nbsp;판매&nbsp;데이터를&nbsp;분석해&nbsp;&#39;BEST&#39;&nbsp;카테고리를&nbsp;만들고,&nbsp;구매&nbsp;전환에&nbsp;유리한&nbsp;상품&nbsp;진열까지&nbsp;최적화해주죠.&nbsp;대표는&nbsp;상품&nbsp;기획에만&nbsp;집중할&nbsp;수&nbsp;있게&nbsp;되는&nbsp;거예요.</p>', NULL, NULL, NULL, '2026-02-25 15:18:21', '2026-02-25 15:18:21', 94, NULL, 'cate2', NULL),
(412, 404, 'ko', 'Story Two', '{\"ops\":[{\"insert\":\"상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용\\n\"}]}', '<p>상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용</p>', NULL, NULL, NULL, '2026-02-25 15:26:21', '2026-02-25 15:26:21', 94, NULL, 'cate3', NULL),
(413, 405, 'ko', 'Story Three', '{\"ops\":[{\"insert\":\"상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용\\n\"}]}', '<p>상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용</p>', NULL, NULL, NULL, '2026-02-25 15:29:36', '2026-02-25 15:29:36', 94, NULL, 'cate4', NULL),
(414, 406, 'ko', 'Story Four', '{\"ops\":[{\"insert\":\"상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용\\n\"}]}', '<p>상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용</p>', NULL, NULL, NULL, '2026-02-25 15:31:46', '2026-02-25 15:31:46', 94, NULL, 'cate1', NULL),
(415, 407, 'ko', 'Story Five', '{\"ops\":[{\"insert\":\"상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용\\n\"}]}', '<p>상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용</p>', NULL, NULL, NULL, '2026-02-25 15:42:54', '2026-02-25 15:42:54', 94, NULL, 'cate2', NULL),
(416, 408, 'ko', 'Story Six', '{\"ops\":[{\"insert\":\"상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용\\n\"}]}', '<p>상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용</p>', NULL, NULL, NULL, '2026-02-25 15:45:07', '2026-02-25 15:45:07', 94, NULL, 'cate3', NULL),
(417, 409, 'ko', 'Story Seven', '{\"ops\":[{\"insert\":\"상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용\\n\"}]}', '<p>상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용</p>', NULL, NULL, NULL, '2026-02-25 15:49:26', '2026-02-25 15:49:26', 94, NULL, 'cate2', NULL),
(418, 410, 'ko', 'Story Eight', '{\"ops\":[{\"insert\":\"상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용\\n\"}]}', '<p>상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용</p>', NULL, NULL, NULL, '2026-02-25 16:00:11', '2026-02-25 16:00:11', 94, NULL, 'cate4', NULL),
(419, 411, 'ko', 'Story Nine', '{\"ops\":[{\"insert\":\"상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용\\n\"}]}', '<p>상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용</p>', NULL, NULL, NULL, '2026-02-25 16:02:13', '2026-02-25 16:02:13', 94, NULL, 'cate1', NULL),
(420, 412, 'ko', 'Story Ten', '{\"ops\":[{\"insert\":\"상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용\\n\"}]}', '<p>상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용상세내용</p>', NULL, NULL, NULL, '2026-02-25 16:03:33', '2026-02-26 16:29:44', 94, 94, 'cate2', NULL),
(421, 413, 'ko', '최소 자본금 기준이 있나요?', '{\"ops\":[{\"insert\":\"특정 산업에 따라 최소 자본금 요건이 다를 수 있습니다. <br>투자자 비자까지 고려하여 사업 유형에 맞는 자본금 기준을 미리 확인하고 준비해야 합니다.\\n\"}]}', '<p>특정&nbsp;산업에&nbsp;따라&nbsp;최소&nbsp;자본금&nbsp;요건이&nbsp;다를&nbsp;수&nbsp;있습니다.&nbsp;&lt;br&gt;투자자&nbsp;비자까지&nbsp;고려하여&nbsp;사업&nbsp;유형에&nbsp;맞는&nbsp;자본금&nbsp;기준을&nbsp;미리&nbsp;확인하고&nbsp;준비해야&nbsp;합니다.</p>', NULL, NULL, NULL, '2026-02-27 10:49:43', '2026-02-27 10:49:43', 94, NULL, NULL, NULL),
(422, 414, 'ko', '외국인 지분 100%로 설립이 가능한지, 꼭 베트남 파트너와 합작해야 하나요?', '{\"ops\":[{\"insert\":\"유한책임회사는 외국인 소유가 100% 가능하지만, 일부 산업에서는 현지 파트너와의 합작이 요구될 수 있습니다. <br>이를 사전에 확인하고 파트너 관계를 설정해야 합니다.\\n\"}]}', '<p>유한책임회사는&nbsp;외국인&nbsp;소유가&nbsp;100%&nbsp;가능하지만,&nbsp;일부&nbsp;산업에서는&nbsp;현지&nbsp;파트너와의&nbsp;합작이&nbsp;요구될&nbsp;수&nbsp;있습니다.&nbsp;&lt;br&gt;이를&nbsp;사전에&nbsp;확인하고&nbsp;파트너&nbsp;관계를&nbsp;설정해야&nbsp;합니다.</p>', NULL, NULL, NULL, '2026-02-27 10:50:17', '2026-02-27 10:50:17', 94, NULL, NULL, NULL),
(423, 415, 'ko', '법인만 내면 바로 사업을 시작해도 되나요?', '{\"ops\":[{\"insert\":\"공장 설립이나, 특정 사업은 추가적인 사업 면허나 인허가가 필요할 수 있습니다. <br>법인 설립 전 해당 산업에 대한 규제 및 허가 사항을 철저히 파악해야 합니다.\\n\"}]}', '<p>공장&nbsp;설립이나,&nbsp;특정&nbsp;사업은&nbsp;추가적인&nbsp;사업&nbsp;면허나&nbsp;인허가가&nbsp;필요할&nbsp;수&nbsp;있습니다.&nbsp;&lt;br&gt;법인&nbsp;설립&nbsp;전&nbsp;해당&nbsp;산업에&nbsp;대한&nbsp;규제&nbsp;및&nbsp;허가&nbsp;사항을&nbsp;철저히&nbsp;파악해야&nbsp;합니다.</p>', NULL, NULL, NULL, '2026-02-27 10:51:07', '2026-02-27 10:51:07', 94, NULL, NULL, NULL),
(424, 416, 'ko', '사무실 없이 사업 등록은 안되나요', '{\"ops\":[{\"insert\":\"베트남 내 사업 등록을 위해서는 사업장 주소가 반드시 등록되어야 하며, 이를 확보하는 과정에서 현지 부동산 법규를 준수해야 합니다.\\n\"}]}', '<p>베트남&nbsp;내&nbsp;사업&nbsp;등록을&nbsp;위해서는&nbsp;사업장&nbsp;주소가&nbsp;반드시&nbsp;등록되어야&nbsp;하며,&nbsp;이를&nbsp;확보하는&nbsp;과정에서&nbsp;현지&nbsp;부동산&nbsp;법규를&nbsp;준수해야&nbsp;합니다.</p>', NULL, NULL, NULL, '2026-02-27 10:51:52', '2026-02-27 10:51:52', 94, NULL, NULL, NULL),
(425, 417, 'ko', '시장 조사 및 비즈니스 계획 수립은 어떻게 하나요?', '{\"ops\":[{\"insert\":\"베트남에서 비즈니스를 시작하기 전, 충분한 시장 조사와 비즈니스 모델 설계가 필요합니다. <br>경쟁 분석, 예상 수익, 시장 동향 등을 바탕으로 명확한 비즈니스 계획을 수립하세요.\\n\"}]}', '<p>베트남에서&nbsp;비즈니스를&nbsp;시작하기&nbsp;전,&nbsp;충분한&nbsp;시장&nbsp;조사와&nbsp;비즈니스&nbsp;모델&nbsp;설계가&nbsp;필요합니다.&nbsp;&lt;br&gt;경쟁&nbsp;분석,&nbsp;예상&nbsp;수익,&nbsp;시장&nbsp;동향&nbsp;등을&nbsp;바탕으로&nbsp;명확한&nbsp;비즈니스&nbsp;계획을&nbsp;수립하세요.</p>', NULL, NULL, NULL, '2026-02-27 10:52:51', '2026-02-27 10:52:51', 94, NULL, NULL, NULL),
(426, 418, 'ko', '회사 이름 선정 및 등록 시 주의할 점이 있나요?', '{\"ops\":[{\"insert\":\"법인 설립을 위해서는 고유한 회사 이름을 선택하고 등록해야 합니다. <br>이름 중복을 피하고, 베트남에서 금지된 특정 단어가 포함되지 않도록 주의하세요.\\n\"}]}', '<p>법인&nbsp;설립을&nbsp;위해서는&nbsp;고유한&nbsp;회사&nbsp;이름을&nbsp;선택하고&nbsp;등록해야&nbsp;합니다.&nbsp;&lt;br&gt;이름&nbsp;중복을&nbsp;피하고,&nbsp;베트남에서&nbsp;금지된&nbsp;특정&nbsp;단어가&nbsp;포함되지&nbsp;않도록&nbsp;주의하세요.</p>', NULL, NULL, NULL, '2026-02-27 10:54:06', '2026-02-27 10:54:06', 94, NULL, NULL, NULL),
(427, 419, 'ko', '법인 설립 신청서 제출은 어떻게 해야하나요?', '{\"ops\":[{\"insert\":\"베트남 투자청(Department of Planning and Investment)에 법인 설립 신청서를 제출해야 합니다. <br>신청서에는 회사 이름, 법인 형태, 주주 정보, 사무소 주소 등 필수 사항을 기재해야 합니다.\\n\"}]}', '<p>베트남&nbsp;투자청(Department&nbsp;of&nbsp;Planning&nbsp;and&nbsp;Investment)에&nbsp;법인&nbsp;설립&nbsp;신청서를&nbsp;제출해야&nbsp;합니다.&nbsp;&lt;br&gt;신청서에는&nbsp;회사&nbsp;이름,&nbsp;법인&nbsp;형태,&nbsp;주주&nbsp;정보,&nbsp;사무소&nbsp;주소&nbsp;등&nbsp;필수&nbsp;사항을&nbsp;기재해야&nbsp;합니다.</p>', NULL, NULL, NULL, '2026-02-27 10:55:31', '2026-02-27 10:55:31', 94, NULL, NULL, NULL),
(428, 420, 'ko', '투자청 심사 및 승인 절차에 대해 알려주세요', '{\"ops\":[{\"insert\":\"투자청은 제출된 신청서를 검토하고 추가 서류를 요청할 수 있습니다. <br>모든 요건이 충족되면 법인 설립 승인을 받게 됩니다.\\n\"}]}', '<p>투자청은&nbsp;제출된&nbsp;신청서를&nbsp;검토하고&nbsp;추가&nbsp;서류를&nbsp;요청할&nbsp;수&nbsp;있습니다.&nbsp;&lt;br&gt;모든&nbsp;요건이&nbsp;충족되면&nbsp;법인&nbsp;설립&nbsp;승인을&nbsp;받게&nbsp;됩니다.</p>', NULL, NULL, NULL, '2026-02-27 10:57:06', '2026-02-27 10:57:06', 94, NULL, NULL, NULL),
(429, 421, 'ko', '사업자 등록증 발급', '{\"ops\":[{\"insert\":\"법인 설립 승인이 완료되면 사업자 등록증이 발급됩니다. <br>이 문서는 법인의 공식적인 존재를 증명하는 중요한 서류입니다.\\n\"}]}', '<p>법인&nbsp;설립&nbsp;승인이&nbsp;완료되면&nbsp;사업자&nbsp;등록증이&nbsp;발급됩니다.&nbsp;&lt;br&gt;이&nbsp;문서는&nbsp;법인의&nbsp;공식적인&nbsp;존재를&nbsp;증명하는&nbsp;중요한&nbsp;서류입니다.</p>', NULL, NULL, NULL, '2026-02-27 10:57:43', '2026-02-27 10:57:43', 94, NULL, NULL, NULL),
(430, 422, 'ko', '세무 등록 절차는 어떻게 이루어지나요?', '{\"ops\":[{\"insert\":\"법인 설립 후, 세무 등록을 완료해야 합니다. <br>이를 통해 세무 신고 및 납부가 가능해지며, 법인의 세금 관련 의무를 다할 수 있습니다.\\n\"}]}', '<p>법인&nbsp;설립&nbsp;후,&nbsp;세무&nbsp;등록을&nbsp;완료해야&nbsp;합니다.&nbsp;&lt;br&gt;이를&nbsp;통해&nbsp;세무&nbsp;신고&nbsp;및&nbsp;납부가&nbsp;가능해지며,&nbsp;법인의&nbsp;세금&nbsp;관련&nbsp;의무를&nbsp;다할&nbsp;수&nbsp;있습니다.</p>', NULL, NULL, NULL, '2026-02-27 10:58:17', '2026-02-27 10:58:17', 94, NULL, NULL, NULL),
(431, 423, 'ko', '사무 공간 및 위치 확보', '{\"ops\":[{\"insert\":\"사업을 위한 사무 공간을 확보하고, 예산과 사업 성격에 맞는 최적의 위치를 선택한 후 임대 계약을 체결해야 합니다.\\n\"}]}', '<p>사업을&nbsp;위한&nbsp;사무&nbsp;공간을&nbsp;확보하고,&nbsp;예산과&nbsp;사업&nbsp;성격에&nbsp;맞는&nbsp;최적의&nbsp;위치를&nbsp;선택한&nbsp;후&nbsp;임대&nbsp;계약을&nbsp;체결해야&nbsp;합니다.</p>', NULL, NULL, NULL, '2026-02-27 10:58:50', '2026-02-27 10:58:50', 94, NULL, NULL, NULL),
(432, 424, 'ko', '법규 준수 및 운영 관리', '{\"ops\":[{\"insert\":\"법인 설립 후에는 베트남의 법률을 준수하며 운영해야 합니다. <br>회계 기록, 환경 규제, 노동법 등 다양한 법적 의무를 철저히 지키는 것이 필수입니다.\\n\"}]}', '<p>법인&nbsp;설립&nbsp;후에는&nbsp;베트남의&nbsp;법률을&nbsp;준수하며&nbsp;운영해야&nbsp;합니다.&nbsp;&lt;br&gt;회계&nbsp;기록,&nbsp;환경&nbsp;규제,&nbsp;노동법&nbsp;등&nbsp;다양한&nbsp;법적&nbsp;의무를&nbsp;철저히&nbsp;지키는&nbsp;것이&nbsp;필수입니다.</p>', NULL, NULL, NULL, '2026-02-27 10:59:22', '2026-02-27 10:59:22', 94, NULL, NULL, NULL),
(433, 425, 'ko', '법규 준수 및 운영 관리', '{\"ops\":[{\"insert\":\"법인 설립 후에는 베트남의 법률을 준수하며 운영해야 합니다. <br>회계 기록, 환경 규제, 노동법 등 다양한 법적 의무를 철저히 지키는 것이 필수입니다.\\n\"}]}', '<p>법인&nbsp;설립&nbsp;후에는&nbsp;베트남의&nbsp;법률을&nbsp;준수하며&nbsp;운영해야&nbsp;합니다.&nbsp;&lt;br&gt;회계&nbsp;기록,&nbsp;환경&nbsp;규제,&nbsp;노동법&nbsp;등&nbsp;다양한&nbsp;법적&nbsp;의무를&nbsp;철저히&nbsp;지키는&nbsp;것이&nbsp;필수입니다.</p>', NULL, NULL, NULL, '2026-02-27 10:59:50', '2026-02-27 10:59:50', 94, NULL, NULL, NULL),
(434, 426, 'ko', '모든 화장품에 위생허가가 필요한가요?', '{\"ops\":[{\"insert\":\"네, 베트남에서 판매되는 모든 화장품(스킨케어, 메이크업, 헤어케어 등)은 위생허가를 받아야 합니다.\\n\"}]}', '<p>네,&nbsp;베트남에서&nbsp;판매되는&nbsp;모든&nbsp;화장품(스킨케어,&nbsp;메이크업,&nbsp;헤어케어&nbsp;등)은&nbsp;위생허가를&nbsp;받아야&nbsp;합니다.</p>', NULL, NULL, NULL, '2026-02-27 11:06:16', '2026-02-27 11:06:16', 94, NULL, NULL, NULL),
(435, 427, 'ko', '위생허가 등록은 얼마나 걸리나요?', '{\"ops\":[{\"insert\":\"일반적으로 신청 후 2개월 정도 소요되며, 서류가 완벽하지 않으면 추가 시간이 걸릴 수 있습니다.\\n\"}]}', '<p>일반적으로&nbsp;신청&nbsp;후&nbsp;2개월&nbsp;정도&nbsp;소요되며,&nbsp;서류가&nbsp;완벽하지&nbsp;않으면&nbsp;추가&nbsp;시간이&nbsp;걸릴&nbsp;수&nbsp;있습니다.</p>', NULL, NULL, NULL, '2026-02-27 11:06:55', '2026-02-27 11:06:55', 94, NULL, NULL, NULL),
(436, 428, 'ko', '위생허가는 몇 년 동안 유효한가요?', '{\"ops\":[{\"insert\":\"베트남 화장품 위생허가는 5년 동안 유효합니다. 이후에는 갱신이 필요합니다.\\n\"}]}', '<p>베트남&nbsp;화장품&nbsp;위생허가는&nbsp;5년&nbsp;동안&nbsp;유효합니다.&nbsp;이후에는&nbsp;갱신이&nbsp;필요합니다.</p>', NULL, NULL, NULL, '2026-02-27 11:07:34', '2026-02-27 11:07:34', 94, NULL, NULL, NULL),
(437, 429, 'ko', '위생허가를 신청하려면 현지 대리인이 필요한가요?', '{\"ops\":[{\"insert\":\"네, 외국 기업은 베트남 내 유통사나 대리인을 통해 위생허가를 신청해야 합니다.\\n\"}]}', '<p>네,&nbsp;외국&nbsp;기업은&nbsp;베트남&nbsp;내&nbsp;유통사나&nbsp;대리인을&nbsp;통해&nbsp;위생허가를&nbsp;신청해야&nbsp;합니다.</p>', NULL, NULL, NULL, '2026-02-27 11:08:19', '2026-02-27 11:08:19', 94, NULL, NULL, NULL),
(438, 430, 'ko', '허가가 거절될 수 있는 이유는 무엇인가요?', '{\"ops\":[{\"insert\":\"제품 성분이 베트남 규정에 맞지 않거나 서류가 불완전한 경우, 허가가 거절될 수 있습니다.\\n\"}]}', '<p>제품&nbsp;성분이&nbsp;베트남&nbsp;규정에&nbsp;맞지&nbsp;않거나&nbsp;서류가&nbsp;불완전한&nbsp;경우,&nbsp;허가가&nbsp;거절될&nbsp;수&nbsp;있습니다.</p>', NULL, NULL, NULL, '2026-02-27 11:08:49', '2026-02-27 11:08:49', 94, NULL, NULL, NULL),
(439, 431, 'ko', '위생허가를 받은 후 추가로 해야 할 절차가 있나요?', '{\"ops\":[{\"insert\":\"제품 유통 시 라벨에 위생허가 번호를 표시해야 하며, 판매 전 세관 통관 절차도 완료해야 합니다.\\n\"}]}', '<p>제품&nbsp;유통&nbsp;시&nbsp;라벨에&nbsp;위생허가&nbsp;번호를&nbsp;표시해야&nbsp;하며,&nbsp;판매&nbsp;전&nbsp;세관&nbsp;통관&nbsp;절차도&nbsp;완료해야&nbsp;합니다.</p>', NULL, NULL, NULL, '2026-02-27 11:10:46', '2026-02-27 11:10:46', 94, NULL, NULL, NULL),
(440, 432, 'ko', '동일 제품의 다양한 색상이나 향도 각각 등록해야 하나요?', '{\"ops\":[{\"insert\":\"색상이나 향이 다르더라도 성분이 동일하다면 한 번의 허가로 등록할 수 있습니다.\\n\"}]}', '<p>색상이나&nbsp;향이&nbsp;다르더라도&nbsp;성분이&nbsp;동일하다면&nbsp;한&nbsp;번의&nbsp;허가로&nbsp;등록할&nbsp;수&nbsp;있습니다.</p>', NULL, NULL, NULL, '2026-02-27 11:11:29', '2026-02-27 11:11:29', 94, NULL, NULL, NULL),
(441, 433, 'ko', '세금은 어떻게 처리해야 하나요?', '{\"ops\":[{\"insert\":\"베트남의 세법과 회계 규정을 숙지하고, 현지 세금 보고와 관련된 절차를 준비해야 합니다. <br>세금 신고와 납부는 반드시 법적 기한 내에 이루어져야 하며, 이를 위한 현지 세무사나 회계사 등 전문가의 도움을 받는 것이 좋습니다.\\n\"}]}', '<p>베트남의&nbsp;세법과&nbsp;회계&nbsp;규정을&nbsp;숙지하고,&nbsp;현지&nbsp;세금&nbsp;보고와&nbsp;관련된&nbsp;절차를&nbsp;준비해야&nbsp;합니다.&nbsp;&lt;br&gt;세금&nbsp;신고와&nbsp;납부는&nbsp;반드시&nbsp;법적&nbsp;기한&nbsp;내에&nbsp;이루어져야&nbsp;하며,&nbsp;이를&nbsp;위한&nbsp;현지&nbsp;세무사나&nbsp;회계사&nbsp;등&nbsp;전문가의&nbsp;도움을&nbsp;받는&nbsp;것이&nbsp;좋습니다.</p>', NULL, NULL, NULL, '2026-02-27 11:13:03', '2026-02-27 11:13:03', 94, NULL, NULL, NULL),
(442, 434, 'ko', '법률 자문 및 전문가 상담은 꼭 받아야 하나요?', '{\"ops\":[{\"insert\":\"베트남의 법적 환경은 자주 변화하므로, 현지 법률 자문사나 비즈니스 컨설턴트와 상담을 통해 법적 규정을 이해하고 초기 계획을 최적화하는 것이 중요합니다.\\n\"}]}', '<p>베트남의&nbsp;법적&nbsp;환경은&nbsp;자주&nbsp;변화하므로,&nbsp;현지&nbsp;법률&nbsp;자문사나&nbsp;비즈니스&nbsp;컨설턴트와&nbsp;상담을&nbsp;통해&nbsp;법적&nbsp;규정을&nbsp;이해하고&nbsp;초기&nbsp;계획을&nbsp;최적화하는&nbsp;것이&nbsp;중요합니다.</p>', NULL, NULL, NULL, '2026-02-27 11:13:46', '2026-02-27 11:13:46', 94, NULL, NULL, NULL),
(443, 435, 'ko', '자본금 설정 및 예치 요건을 알려주세요', '{\"ops\":[{\"insert\":\"법인 설립 시, 자본금 요건을 충족해야 합니다. <br>유한책임회사의 경우 최소 100만 VND 이상, 주식회사는 10억 VND 이상의 자본금이 필요하며, 이를 은행 계좌에 예치해야 합니다.\\n\"}]}', '<p>법인&nbsp;설립&nbsp;시,&nbsp;자본금&nbsp;요건을&nbsp;충족해야&nbsp;합니다.&nbsp;&lt;br&gt;유한책임회사의&nbsp;경우&nbsp;최소&nbsp;100만&nbsp;VND&nbsp;이상,&nbsp;주식회사는&nbsp;10억&nbsp;VND&nbsp;이상의&nbsp;자본금이&nbsp;필요하며,&nbsp;이를&nbsp;은행&nbsp;계좌에&nbsp;예치해야&nbsp;합니다.</p>', NULL, NULL, NULL, '2026-02-27 11:14:24', '2026-02-27 11:14:24', 94, NULL, NULL, NULL),
(444, 436, 'ko', '위생허가 등록에 필요한 주요 서류는 무엇인가요?', '{\"ops\":[{\"insert\":\"LOA 및 CFS와 제품의 성분표, 제품 라벨지 베트남어 번역본 등이 필요합니다.\\n\"}]}', '<p>LOA&nbsp;및&nbsp;CFS와&nbsp;제품의&nbsp;성분표,&nbsp;제품&nbsp;라벨지&nbsp;베트남어&nbsp;번역본&nbsp;등이&nbsp;필요합니다.</p>', NULL, NULL, NULL, '2026-02-27 11:15:00', '2026-02-27 11:15:00', 94, NULL, NULL, NULL),
(445, 437, 'ko', '위생허가 등록 비용은 얼마인가요?', '{\"ops\":[{\"insert\":\"제품 종류와 수량에 따라 다르며, 공증인증 비용 또한 별도로 발생됩니다. 최종 등록할 제품을 알려주시면 비용을 정리하여 회신드리고 있습니다.\\n\"}]}', '<p>제품&nbsp;종류와&nbsp;수량에&nbsp;따라&nbsp;다르며,&nbsp;공증인증&nbsp;비용&nbsp;또한&nbsp;별도로&nbsp;발생됩니다.&nbsp;최종&nbsp;등록할&nbsp;제품을&nbsp;알려주시면&nbsp;비용을&nbsp;정리하여&nbsp;회신드리고&nbsp;있습니다.</p>', NULL, NULL, NULL, '2026-02-27 11:15:34', '2026-02-27 11:15:34', 94, NULL, NULL, NULL),
(446, 438, 'ko', '등록한 위생허가를 다른 제품에도 사용할 수 있나요?', '{\"ops\":[{\"insert\":\"아니요, 위생허가는 제품별로 발급되므로 다른 제품에는 사용할 수 없습니다.\\n\"}]}', '<p>아니요,&nbsp;위생허가는&nbsp;제품별로&nbsp;발급되므로&nbsp;다른&nbsp;제품에는&nbsp;사용할&nbsp;수&nbsp;없습니다.</p>', NULL, NULL, NULL, '2026-02-27 11:16:08', '2026-02-27 11:16:08', 94, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES
(89, 94, 'superadmin', '2026-02-02 11:53:17'),
(90, 101, 'user', '2026-03-17 12:39:46'),
(93, 106, 'user', '2026-04-09 10:36:36'),
(94, 107, 'user', '2026-04-24 18:52:04'),
(95, 108, 'admin', '2026-04-27 11:49:28');

-- --------------------------------------------------------

--
-- 表的结构 `auth_identities`
--

CREATE TABLE `auth_identities` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `type` varchar(191) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `secret` varchar(191) NOT NULL,
  `secret2` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text,
  `force_reset` tinyint(1) NOT NULL DEFAULT '0',
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `auth_identities`
--

INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(146, 94, 'email_password', NULL, 'haocms@haoweb.co.kr', '$2y$12$Wdj5vcEFtU1Rdxgtdt9XR.oG6WWGLxCuqNZIRkKvsZu2kW1nZjcI.', NULL, NULL, 0, '2026-04-14 14:03:38', '2026-02-02 11:53:17', '2026-04-14 14:03:38'),
(148, 101, 'email_password', NULL, 'meeneex2@gmail.com', '$2y$12$5N.H0Q1QiuBF/rkkliQzEOxntY9O.H85BOXPCI2NGhmVxuujN3oJy', NULL, NULL, 0, NULL, '2026-03-17 12:39:46', '2026-03-17 12:39:46'),
(152, 106, 'email_password', NULL, '01022223333@phone.local', '$2y$12$fVs2umjkb9uF4a5LVMjUguNXSOnK6EJ36j8Benr9Qv0f2SvqNcsie', NULL, NULL, 0, '2026-04-09 17:44:52', '2026-04-09 10:36:36', '2026-04-09 17:44:52'),
(153, 107, 'email_password', NULL, 'sales@redtrans.co.kr', '$2y$12$oS0PGW4V995FX30gm/yXduiXzwCtpxEYHyf1T2X2/JagBHOUGWnn.', NULL, NULL, 0, NULL, '2026-04-24 18:52:04', '2026-04-24 18:52:04'),
(154, 108, 'email_password', NULL, '525669315@qq.com', '$2y$12$Cmk1siRDymjJyxzk.g6IF.vOQ9DIX05Dd722pjTiPJhTUgyGo1EBu', NULL, NULL, 0, NULL, '2026-04-27 11:49:28', '2026-04-27 11:49:28');

-- --------------------------------------------------------

--
-- 表的结构 `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(108, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'email_password', '526275688@qq.com', NULL, '2026-01-30 17:52:59', 0),
(109, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', NULL, '2026-02-02 11:52:19', 0),
(110, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-02-02 16:30:54', 1),
(111, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-02-03 10:10:30', 1),
(112, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'info@naturepos.co.kr', 95, '2026-02-03 18:58:12', 1),
(113, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'info@naturepos.co.kr', 95, '2026-02-04 11:08:08', 1),
(114, '113.226.91.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'info@naturepos.co.kr', 95, '2026-02-04 11:22:20', 1),
(115, '113.226.91.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-02-04 11:22:58', 1),
(116, '211.194.185.30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'info@naturepos.co.kr', NULL, '2026-02-10 14:22:10', 0),
(117, '211.194.185.30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'info@naturepos.co.kr', NULL, '2026-02-10 14:22:19', 0),
(118, '211.194.185.30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'info@naturepos.co.kr', NULL, '2026-02-10 14:22:36', 0),
(119, '211.194.185.30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'info@naturepos.co.kr', 95, '2026-02-10 14:22:56', 1),
(120, '119.112.223.231', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-02-24 10:43:02', 1),
(121, '119.112.223.231', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-02-25 10:05:26', 1),
(122, '119.112.223.231', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-02-26 10:31:02', 1),
(123, '119.112.223.231', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-02-27 10:07:15', 1),
(124, '119.112.223.231', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-02-27 18:34:52', 1),
(125, '119.112.223.231', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-03-02 10:11:56', 1),
(126, '119.112.223.231', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-03-02 18:58:25', 1),
(127, '119.112.223.231', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-03-03 09:52:44', 1),
(128, '113.226.95.172', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'lzw0411@outlook.com', NULL, '2026-03-03 10:41:25', 0),
(129, '113.226.95.172', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'lzw0411@outlook.com', NULL, '2026-03-03 10:43:00', 0),
(130, '113.226.95.172', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'Lzw900411@Outlook.com', NULL, '2026-03-03 10:51:48', 0),
(131, '113.226.95.172', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'lzw0411@outlook.com', NULL, '2026-03-03 10:54:14', 0),
(132, '113.226.95.172', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'lzw0411@outlook.com', NULL, '2026-03-03 10:54:38', 0),
(133, '121.170.203.153', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'lzw0411@outlook.com', NULL, '2026-03-03 11:11:52', 0),
(134, '121.170.203.153', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-03-04 10:16:55', 1),
(135, '121.170.203.153', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', NULL, '2026-03-04 12:26:30', 0),
(136, '121.170.203.153', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-03-04 12:26:41', 1),
(137, '113.226.95.172', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-03-05 10:26:42', 1),
(138, '113.226.95.172', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-03-06 10:31:24', 1),
(139, '113.226.95.172', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-03-09 11:29:23', 1),
(140, '113.226.95.172', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', NULL, '2026-03-09 12:40:21', 0),
(141, '113.226.95.172', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-03-09 12:40:29', 1),
(142, '221.139.79.36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-03-17 12:26:17', 1),
(143, '221.139.79.36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'kakao_oauth', 'meeneex2@gmail.com', 101, '2026-03-17 12:39:46', 1),
(144, '221.139.79.36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'kakao_oauth', 'meeneex2@gmail.com', 101, '2026-03-17 16:08:38', 1),
(145, '221.139.79.36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'kakao_oauth', 'meeneex2@gmail.com', 101, '2026-03-17 16:09:36', 1),
(146, '221.139.79.36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'kakao_oauth', 'meeneex2@gmail.com', 101, '2026-03-17 16:20:44', 1),
(147, '221.139.79.36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'kakao_oauth', 'meeneex2@gmail.com', 101, '2026-03-17 16:29:24', 1),
(148, '119.113.125.49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-03-18 10:16:01', 1),
(149, '119.113.125.49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-03-19 10:35:27', 1),
(150, '218.38.103.149', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-03-19 17:34:16', 1),
(151, '218.38.103.149', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-03-20 09:55:23', 1),
(152, '119.113.125.49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-03-23 11:29:36', 1),
(153, '221.139.79.25', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-03-23 18:30:54', 1),
(154, '218.237.185.232', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-03-25 17:49:31', 1),
(155, '168.126.234.241', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-04-02 16:17:43', 1),
(156, '27.255.82.25', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-04-02 16:19:42', 1),
(157, '221.139.79.50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'phone', '01026598745', 120, '2026-04-08 16:27:02', 1),
(158, '221.139.79.50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-04-08 17:03:14', 1),
(159, '221.139.79.50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'phone', '01058585959', 121, '2026-04-08 17:06:06', 1),
(160, '221.139.79.50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'phone', '01058585959', NULL, '2026-04-08 18:37:41', 0),
(161, '221.139.79.50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'phone', '01058585959', 121, '2026-04-08 18:37:56', 1),
(162, '221.139.79.50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'phone', '01058585959', 121, '2026-04-08 18:44:25', 1),
(163, '221.139.79.50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-04-09 14:05:59', 1),
(164, '221.139.79.50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'phone', '01022223333', 106, '2026-04-09 17:44:19', 1),
(165, '221.139.79.50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'phone', '01022223333', 106, '2026-04-09 17:44:52', 1),
(166, '221.139.79.50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-04-09 17:52:12', 1),
(167, '121.170.203.131', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-04-13 17:55:52', 1),
(168, '121.170.203.131', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'email_password', 'haocms@haoweb.co.kr', 94, '2026-04-14 14:03:38', 1),
(169, '158.247.253.95', 'User-Agent: Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; 360SE)', 'phone', '1', NULL, '2026-05-04 10:10:23', 0);

-- --------------------------------------------------------

--
-- 表的结构 `auth_permissions_users`
--

CREATE TABLE `auth_permissions_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `permission` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `auth_remember_tokens`
--

CREATE TABLE `auth_remember_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(191) NOT NULL,
  `hashedValidator` varchar(191) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `auth_token_logins`
--

CREATE TABLE `auth_token_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `parent_id` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `title` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `is_hot` tinyint(1) DEFAULT NULL,
  `is_main` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `use_fields` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `active`, `title`, `subject`, `description`, `icon`, `url`, `sequence`, `is_hot`, `is_main`, `created_at`, `updated_at`, `use_fields`) VALUES
(89, 0, 1, 'FAQ', '', '', '', NULL, 2, 0, 0, '2026-02-02 11:54:29', '2026-02-26 16:24:23', '{\"title\":{\"enabled\":true,\"required\":false,\"type\":\"text\"},\"content\":{\"enabled\":true,\"required\":false,\"type\":\"editor\"}}'),
(90, 89, 1, '상표등록 대리', '', '', '', NULL, 3, 0, 0, '2026-02-02 11:54:57', '2026-02-27 10:37:44', '{\"title\":{\"enabled\":true,\"required\":false,\"type\":\"text\"},\"content\":{\"enabled\":true,\"required\":false,\"type\":\"editor\"}}'),
(95, 0, 1, '민원노트', '', '', '', NULL, 6, 0, 0, '2026-02-24 18:12:33', '2026-02-26 16:24:23', '{\"title\":{\"enabled\":true,\"required\":false,\"type\":\"text\"},\"subject\":{\"enabled\":true,\"required\":false,\"type\":\"text\"},\"description\":{\"enabled\":true,\"required\":false,\"type\":\"textarea\"},\"thumbnail\":{\"enabled\":true,\"required\":false,\"type\":\"image\",\"width\":172,\"height\":172}}'),
(97, 95, 1, '민원노트', '', '', '', NULL, 7, 0, 0, '2026-02-24 18:35:14', '2026-02-26 16:24:23', '{}'),
(98, 0, 1, '스토리', 'Story', '', '', NULL, 10, 0, 0, '2026-02-25 11:34:29', '2026-02-26 16:28:15', '{\"title\":{\"enabled\":true,\"required\":false,\"type\":\"text\"},\"subject\":{\"enabled\":true,\"required\":false,\"type\":\"text\"},\"thumbnail\":{\"enabled\":true,\"required\":false,\"type\":\"image\",\"width\":680,\"height\":380},\"content\":{\"enabled\":true,\"required\":false,\"type\":\"editor\"}}'),
(102, 98, 1, 'story1', '', '', '', NULL, 13, 0, 0, '2026-02-25 15:01:06', '2026-02-26 16:24:23', '{}'),
(103, 98, 1, 'story2', '', '', '', NULL, 15, 0, 0, '2026-02-25 15:01:37', '2026-02-26 16:24:23', '{}'),
(104, 98, 1, 'story3', '', '', '', NULL, 16, 0, 0, '2026-02-25 15:01:49', '2026-02-25 15:01:49', '{}'),
(106, 89, 1, '법인 설립', '', '', '', NULL, 17, 0, 0, '2026-02-27 10:45:23', '2026-02-27 10:45:23', '{\"title\":{\"enabled\":true,\"required\":false,\"type\":\"text\"},\"content\":{\"enabled\":true,\"required\":false,\"type\":\"editor\"}}'),
(107, 89, 1, '화장품', '', '', '', NULL, 18, 0, 0, '2026-02-27 11:04:42', '2026-02-27 11:04:42', '{\"title\":{\"enabled\":true,\"required\":false,\"type\":\"text\"},\"content\":{\"enabled\":true,\"required\":false,\"type\":\"editor\"}}');

-- --------------------------------------------------------

--
-- 表的结构 `email_queue`
--

CREATE TABLE `email_queue` (
  `id` int(11) UNSIGNED NOT NULL,
  `to_email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` enum('pending','processing','completed','failed') NOT NULL DEFAULT 'pending',
  `batch_id` varchar(50) DEFAULT NULL COMMENT '用于并发锁定的批次号',
  `attempts` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `error_log` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `email_queue`
--

INSERT INTO `email_queue` (`id`, `to_email`, `subject`, `message`, `status`, `batch_id`, `attempts`, `error_log`, `created_at`, `updated_at`) VALUES
(5, '526275688@qq.com', '농업회사법인(주)네이처포스: 신규문의가 접수되었습니다', '<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\"\r\n       style=\"background:#f5f6f8;padding:30px 0;font-family:Arial,Helvetica,sans-serif;\">\r\n    <tr>\r\n        <td align=\"center\">\r\n\r\n            <!-- 主卡片 -->\r\n            <table width=\"620\" cellpadding=\"0\" cellspacing=\"0\"\r\n                   style=\"background:#ffffff;border:1px solid #e5e7eb;border-radius:6px;\">\r\n\r\n                <!-- 标题 -->\r\n                <tr>\r\n                    <td style=\"padding:18px 28px;border-bottom:1px solid #eeeeee;\">\r\n                        <strong style=\"font-size:16px;color:#111827;\">\r\n                            📩 농업회사법인(주)네이처포스:신규문의가 접수되었습니다                        </strong>\r\n                    </td>\r\n                </tr>\r\n\r\n                <!-- 表单内容 -->\r\n                <tr>\r\n                    <td style=\"padding:20px 28px;\">\r\n\r\n                        <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        Title                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            titletitletitletitle\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        Author                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            AuthorAuthorAuthorAuthor\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        Email                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            526275688@qq.com\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        Content                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            ContentContentContentContentContent\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        Consent to collect and use personal information                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            I agree.\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                            \r\n                        </table>\r\n\r\n                    </td>\r\n                </tr>\r\n\r\n                <!-- 底部信息 -->\r\n                <tr>\r\n                    <td style=\"background:#fafafa;padding:14px 28px;font-size:12px;color:#6b7280;\">\r\n                        IP: ::1<br>\r\n                        USER AGENT: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36<br>\r\n                        DATE: 2026-02-03 16:59:04                    </td>\r\n                </tr>\r\n\r\n            </table>\r\n\r\n        </td>\r\n    </tr>\r\n</table>\r\n', 'completed', NULL, 0, NULL, '2026-02-03 16:59:04', '2026-02-03 16:59:10'),
(6, '526275688@qq.com', '농업회사법인(주)네이처포스: 신규문의가 접수되었습니다', '<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\"\r\n       style=\"background:#f5f6f8;padding:30px 0;font-family:Arial,Helvetica,sans-serif;\">\r\n    <tr>\r\n        <td align=\"center\">\r\n\r\n            <!-- 主卡片 -->\r\n            <table width=\"620\" cellpadding=\"0\" cellspacing=\"0\"\r\n                   style=\"background:#ffffff;border:1px solid #e5e7eb;border-radius:6px;\">\r\n\r\n                <!-- 标题 -->\r\n                <tr>\r\n                    <td style=\"padding:18px 28px;border-bottom:1px solid #eeeeee;\">\r\n                        <strong style=\"font-size:16px;color:#111827;\">\r\n                            📩 농업회사법인(주)네이처포스:신규문의가 접수되었습니다                        </strong>\r\n                    </td>\r\n                </tr>\r\n\r\n                <!-- 表单内容 -->\r\n                <tr>\r\n                    <td style=\"padding:20px 28px;\">\r\n\r\n                        <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        Title                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            Title*\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        Author                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            Title*\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        Email                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            asd@qq.com\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        Content                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            Title*\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        Consent to collect and use personal information                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            I agree.\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                            \r\n                        </table>\r\n\r\n                    </td>\r\n                </tr>\r\n\r\n                <!-- 底部信息 -->\r\n                <tr>\r\n                    <td style=\"background:#fafafa;padding:14px 28px;font-size:12px;color:#6b7280;\">\r\n                        IP: 113.226.91.202<br>\r\n                        USER AGENT: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36<br>\r\n                        DATE: 2026-02-04 11:53:44                    </td>\r\n                </tr>\r\n\r\n            </table>\r\n\r\n        </td>\r\n    </tr>\r\n</table>\r\n', 'completed', NULL, 0, NULL, '2026-02-04 11:53:44', '2026-02-04 11:53:50'),
(7, '525669315@qq.com', 'Redtrans: 신규문의가 접수되었습니다', '<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\"\r\n       style=\"background:#f5f6f8;padding:30px 0;font-family:Arial,Helvetica,sans-serif;\">\r\n    <tr>\r\n        <td align=\"center\">\r\n\r\n            <!-- 主卡片 -->\r\n            <table width=\"620\" cellpadding=\"0\" cellspacing=\"0\"\r\n                   style=\"background:#ffffff;border:1px solid #e5e7eb;border-radius:6px;\">\r\n\r\n                <!-- 标题 -->\r\n                <tr>\r\n                    <td style=\"padding:18px 28px;border-bottom:1px solid #eeeeee;\">\r\n                        <strong style=\"font-size:16px;color:#111827;\">\r\n                            📩 Redtrans:신규문의가 접수되었습니다                        </strong>\r\n                    </td>\r\n                </tr>\r\n\r\n                <!-- 表单内容 -->\r\n                <tr>\r\n                    <td style=\"padding:20px 28px;\">\r\n\r\n                        <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        &lt;span style=&quot;color: rgb(31, 31, 31);&quot;&gt;업체명&lt;/span&gt;                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            21321321\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        &lt;span style=&quot;color: rgb(31, 31, 31);&quot;&gt;지역(도)&lt;/span&gt;                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            321321\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        &lt;span style=&quot;color: rgb(31, 31, 31);&quot;&gt;이름/직함&lt;/span&gt;                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            321321\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        &lt;span style=&quot;color: rgb(31, 31, 31);&quot;&gt;연락처&lt;/span&gt;                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            321321\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        &lt;span style=&quot;color: rgb(31, 31, 31);&quot;&gt;이메일 주소&lt;/span&gt;                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            525669315@qq.com\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        &lt;span style=&quot;color: rgb(31, 31, 31);&quot;&gt;문의 서비스&lt;/span&gt;                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            전세계 대사관인증\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        &lt;span style=&quot;color: rgb(31, 31, 31);&quot;&gt;기타 문의 및 요구사항&lt;/span&gt;                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            213213\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                                                            </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            agree\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                            \r\n                        </table>\r\n\r\n                    </td>\r\n                </tr>\r\n\r\n                <!-- 底部信息 -->\r\n                <tr>\r\n                    <td style=\"background:#fafafa;padding:14px 28px;font-size:12px;color:#6b7280;\">\r\n                        IP: 121.170.203.142<br>\r\n                        USER AGENT: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36<br>\r\n                        DATE: 2026-03-05 12:23:24                    </td>\r\n                </tr>\r\n\r\n            </table>\r\n\r\n        </td>\r\n    </tr>\r\n</table>\r\n', 'completed', NULL, 0, NULL, '2026-03-05 12:23:24', '2026-03-05 12:23:49'),
(8, '525669315@qq.com', 'Redtrans: 신규문의가 접수되었습니다', '<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\"\r\n       style=\"background:#f5f6f8;padding:30px 0;font-family:Arial,Helvetica,sans-serif;\">\r\n    <tr>\r\n        <td align=\"center\">\r\n\r\n            <!-- 主卡片 -->\r\n            <table width=\"620\" cellpadding=\"0\" cellspacing=\"0\"\r\n                   style=\"background:#ffffff;border:1px solid #e5e7eb;border-radius:6px;\">\r\n\r\n                <!-- 标题 -->\r\n                <tr>\r\n                    <td style=\"padding:18px 28px;border-bottom:1px solid #eeeeee;\">\r\n                        <strong style=\"font-size:16px;color:#111827;\">\r\n                            📩 Redtrans:신규문의가 접수되었습니다                        </strong>\r\n                    </td>\r\n                </tr>\r\n\r\n                <!-- 表单内容 -->\r\n                <tr>\r\n                    <td style=\"padding:20px 28px;\">\r\n\r\n                        <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        &lt;span style=&quot;color: rgb(31, 31, 31);&quot;&gt;업체명&lt;/span&gt;                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            21321321\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        &lt;span style=&quot;color: rgb(31, 31, 31);&quot;&gt;지역(도)&lt;/span&gt;                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            3213213\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        &lt;span style=&quot;color: rgb(31, 31, 31);&quot;&gt;이름/직함&lt;/span&gt;                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            2132132\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        &lt;span style=&quot;color: rgb(31, 31, 31);&quot;&gt;연락처&lt;/span&gt;                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            132132123213\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        &lt;span style=&quot;color: rgb(31, 31, 31);&quot;&gt;이메일 주소&lt;/span&gt;                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            525669315@qq.com\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        &lt;span style=&quot;color: rgb(31, 31, 31);&quot;&gt;문의 서비스&lt;/span&gt;                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            법인 빈원 서류\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                        &lt;span style=&quot;color: rgb(31, 31, 31);&quot;&gt;기타 문의 및 요구사항&lt;/span&gt;                                    </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            1321321\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                                                                                            <tr>\r\n                                    <!-- Label -->\r\n                                    <td width=\"160\"\r\n                                        style=\"padding:10px 0;color:#6b7280;font-size:13px;vertical-align:top;\">\r\n                                                                            </td>\r\n\r\n                                    <!-- Value -->\r\n                                    <td style=\"padding:10px 0;color:#111827;font-size:14px;\">\r\n\r\n                                        \r\n                                            agree\r\n                                        \r\n                                    </td>\r\n                                </tr>\r\n\r\n                                <!-- 分割线 -->\r\n                                <tr>\r\n                                    <td colspan=\"2\" style=\"border-bottom:1px solid #f1f1f1;\"></td>\r\n                                </tr>\r\n\r\n                                                            \r\n                        </table>\r\n\r\n                    </td>\r\n                </tr>\r\n\r\n                <!-- 底部信息 -->\r\n                <tr>\r\n                    <td style=\"background:#fafafa;padding:14px 28px;font-size:12px;color:#6b7280;\">\r\n                        IP: 121.170.203.142<br>\r\n                        USER AGENT: Mozilla/5.0 (iPhone; CPU iPhone OS 16_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.1<br>\r\n                        DATE: 2026-03-05 15:58:07                    </td>\r\n                </tr>\r\n\r\n            </table>\r\n\r\n        </td>\r\n    </tr>\r\n</table>\r\n', 'completed', NULL, 0, NULL, '2026-03-05 15:58:07', '2026-03-05 15:58:26');

-- --------------------------------------------------------

--
-- 表的结构 `family_sites`
--

CREATE TABLE `family_sites` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `lang` varchar(255) DEFAULT NULL,
  `open_new` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `forms`
--

CREATE TABLE `forms` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `submit_email` varchar(255) DEFAULT NULL,
  `success_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `version` int(11) DEFAULT NULL,
  `fields` longtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `lang` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `forms`
--

INSERT INTO `forms` (`id`, `code`, `name`, `submit_email`, `success_message`, `active`, `version`, `fields`, `created_at`, `updated_at`, `deleted_at`, `lang`) VALUES
(121, 'CONTACT_US', '문의하기', '525669315@qq.com', '신규문의가 접수되었습니다', 1, 28, '[{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">업체명</span>\",\"placeholder\":\"개인 고객일 시 개인으로 기재해주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678090952-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">지역(도)</span>\",\"placeholder\":\"지역을 간략히 적어주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678528736-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">이름/직함</span>\",\"placeholder\":\"이름/직함을 적어주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678127422-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">연락처</span>\",\"placeholder\":\"- 없이 숫자만 적어주세요 \",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678151198-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"subtype\":\"email\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">이메일 주소</span>\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678181887-0\",\"access\":false},{\"type\":\"select\",\"required\":false,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">문의 서비스</span>\",\"className\":\"form-control col-sm-6\",\"name\":\"select-1772678714741-0\",\"access\":false,\"multiple\":false,\"values\":[{\"label\":\"중국 민원 서류\",\"value\":\"중국 민원 서류\",\"selected\":true},{\"label\":\"베트남 민원 서류\",\"value\":\"베트남 민원 서류\",\"selected\":false},{\"label\":\"전세계 대사관인증\",\"value\":\"전세계 대사관인증\",\"selected\":false},{\"label\":\"아포스티유\",\"value\":\"아포스티유\",\"selected\":false},{\"label\":\"공증 촉탁 대행\",\"value\":\"공증 촉탁 대행\",\"selected\":false},{\"label\":\"법인 빈원 서류\",\"value\":\"법인 빈원 서류\",\"selected\":false},{\"label\":\"해외 현지 서류\",\"value\":\"해외 현지 서류\",\"selected\":false},{\"label\":\"번역\",\"value\":\"번역\",\"selected\":false}]},{\"type\":\"textarea\",\"required\":false,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">기타 문의 및 요구사항</span>\",\"className\":\"form-control\",\"name\":\"textarea-1772678587116-0\",\"access\":false,\"subtype\":\"textarea\",\"rows\":5},{\"type\":\"paragraph\",\"subtype\":\"p\",\"label\":\"<span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">개인정보처리방침</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">1. 개인정보의 처리 목적</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">&lt;레드트랜스 비자 및 대사관인증 발급대행 서비스&gt;(‘http://redtrans.co.kr/’이하 ‘레드트랜스’)는 다음의 목적을 위하여 개인정보를 처리하고</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">있으며, 다음의 목적 이외의 용도로는 이용하지 않습니다.</span><br>\",\"className\":\"agreements\",\"access\":false},{\"type\":\"checkbox-group\",\"required\":true,\"toggle\":false,\"inline\":false,\"className\":\"col-sm-12 agree\",\"name\":\"checkbox-group-1772677119218-0\",\"access\":false,\"other\":false,\"values\":[{\"label\":\"개인정보처리방침에 동의합니다.\",\"value\":\"agree\",\"selected\":true}]},{\"type\":\"button\",\"subtype\":\"submit\",\"label\":\"<span style=\\\"color: rgb(31, 31, 31); font-family: consolas, \\\" lucida=\\\"\\\" console\\\",=\\\"\\\" \\\"courier=\\\"\\\" new\\\",=\\\"\\\" monospace;=\\\"\\\" font-size:=\\\"\\\" 12px;=\\\"\\\" white-space-collapse:=\\\"\\\" preserve;\\\"=\\\"\\\">문의하기</span>\",\"className\":\"submit btn-default btn\",\"name\":\"button-1770104904862-0\",\"access\":false,\"style\":\"default\"}]', '2026-03-05 11:47:29', '2026-03-05 11:47:29', NULL, 'ko'),
(122, 'CONTACT_US', '문의하기', '525669315@qq.com', '신규문의가 접수되었습니다', 1, 29, '[{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">업체명</span>\",\"placeholder\":\"개인 고객일 시 개인으로 기재해주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678090952-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">지역(도)</span>\",\"placeholder\":\"지역을 간략히 적어주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678528736-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">이름/직함</span>\",\"placeholder\":\"이름/직함을 적어주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678127422-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">연락처</span>\",\"placeholder\":\"- 없이 숫자만 적어주세요 \",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678151198-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"subtype\":\"email\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">이메일 주소</span>\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678181887-0\",\"access\":false},{\"type\":\"select\",\"required\":false,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">문의 서비스</span>\",\"className\":\"form-control col-sm-6\",\"name\":\"select-1772678714741-0\",\"access\":false,\"multiple\":false,\"values\":[{\"label\":\"중국 민원 서류\",\"value\":\"중국 민원 서류\",\"selected\":true},{\"label\":\"베트남 민원 서류\",\"value\":\"베트남 민원 서류\",\"selected\":false},{\"label\":\"전세계 대사관인증\",\"value\":\"전세계 대사관인증\",\"selected\":false},{\"label\":\"아포스티유\",\"value\":\"아포스티유\",\"selected\":false},{\"label\":\"공증 촉탁 대행\",\"value\":\"공증 촉탁 대행\",\"selected\":false},{\"label\":\"법인 빈원 서류\",\"value\":\"법인 빈원 서류\",\"selected\":false},{\"label\":\"해외 현지 서류\",\"value\":\"해외 현지 서류\",\"selected\":false},{\"label\":\"번역\",\"value\":\"번역\",\"selected\":false}]},{\"type\":\"textarea\",\"required\":false,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">기타 문의 및 요구사항</span>\",\"className\":\"form-group col-sm-12\",\"name\":\"textarea-1772678587116-0\",\"access\":false,\"subtype\":\"textarea\",\"rows\":5},{\"type\":\"paragraph\",\"subtype\":\"p\",\"label\":\"<span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">개인정보처리방침</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">1. 개인정보의 처리 목적</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">&lt;레드트랜스 비자 및 대사관인증 발급대행 서비스&gt;(‘http://redtrans.co.kr/’이하 ‘레드트랜스’)는 다음의 목적을 위하여 개인정보를 처리하고</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">있으며, 다음의 목적 이외의 용도로는 이용하지 않습니다.</span><br>\",\"className\":\"agreements\",\"access\":false},{\"type\":\"checkbox-group\",\"required\":true,\"toggle\":false,\"inline\":false,\"className\":\"col-sm-12 agree\",\"name\":\"checkbox-group-1772677119218-0\",\"access\":false,\"other\":false,\"values\":[{\"label\":\"개인정보처리방침에 동의합니다.\",\"value\":\"agree\",\"selected\":true}]},{\"type\":\"button\",\"subtype\":\"submit\",\"label\":\"<span style=\\\"color: rgb(31, 31, 31); font-family: consolas, \\\" lucida=\\\"\\\" console\\\",=\\\"\\\" \\\"courier=\\\"\\\" new\\\",=\\\"\\\" monospace;=\\\"\\\" font-size:=\\\"\\\" 12px;=\\\"\\\" white-space-collapse:=\\\"\\\" preserve;\\\"=\\\"\\\">문의하기</span>\",\"className\":\"submit btn-default btn\",\"name\":\"button-1770104904862-0\",\"access\":false,\"style\":\"default\"}]', '2026-03-05 11:53:55', '2026-03-05 11:53:55', NULL, 'ko'),
(123, 'CONTACT_US', '문의하기', '525669315@qq.com', '신규문의가 접수되었습니다', 1, 29, '[{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">업체명</span>\",\"placeholder\":\"개인 고객일 시 개인으로 기재해주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678090952-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">지역(도)</span>\",\"placeholder\":\"지역을 간략히 적어주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678528736-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">이름/직함</span>\",\"placeholder\":\"이름/직함을 적어주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678127422-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">연락처</span>\",\"placeholder\":\"- 없이 숫자만 적어주세요 \",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678151198-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"subtype\":\"email\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">이메일 주소</span>\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678181887-0\",\"access\":false},{\"type\":\"select\",\"required\":false,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">문의 서비스</span>\",\"className\":\"form-control col-sm-6\",\"name\":\"select-1772678714741-0\",\"access\":false,\"multiple\":false,\"values\":[{\"label\":\"중국 민원 서류\",\"value\":\"중국 민원 서류\",\"selected\":true},{\"label\":\"베트남 민원 서류\",\"value\":\"베트남 민원 서류\",\"selected\":false},{\"label\":\"전세계 대사관인증\",\"value\":\"전세계 대사관인증\",\"selected\":false},{\"label\":\"아포스티유\",\"value\":\"아포스티유\",\"selected\":false},{\"label\":\"공증 촉탁 대행\",\"value\":\"공증 촉탁 대행\",\"selected\":false},{\"label\":\"법인 빈원 서류\",\"value\":\"법인 빈원 서류\",\"selected\":false},{\"label\":\"해외 현지 서류\",\"value\":\"해외 현지 서류\",\"selected\":false},{\"label\":\"번역\",\"value\":\"번역\",\"selected\":false}]},{\"type\":\"textarea\",\"required\":false,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">기타 문의 및 요구사항</span>\",\"className\":\"form-group col-sm-12\",\"name\":\"textarea-1772679267069-0\",\"access\":false,\"subtype\":\"textarea\",\"rows\":5},{\"type\":\"paragraph\",\"subtype\":\"p\",\"label\":\"<span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">개인정보처리방침</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">1. 개인정보의 처리 목적</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">&lt;레드트랜스 비자 및 대사관인증 발급대행 서비스&gt;(‘http://redtrans.co.kr/’이하 ‘레드트랜스’)는 다음의 목적을 위하여 개인정보를 처리하고</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">있으며, 다음의 목적 이외의 용도로는 이용하지 않습니다.</span><br>\",\"className\":\"agreements\",\"access\":false},{\"type\":\"checkbox-group\",\"required\":true,\"toggle\":false,\"inline\":false,\"className\":\"col-sm-12 agree\",\"name\":\"checkbox-group-1772677119218-0\",\"access\":false,\"other\":false,\"values\":[{\"label\":\"개인정보처리방침에 동의합니다.\",\"value\":\"agree\",\"selected\":true}]},{\"type\":\"button\",\"subtype\":\"submit\",\"label\":\"<span style=\\\"color: rgb(31, 31, 31); font-family: consolas, \\\" lucida=\\\"\\\" console\\\",=\\\"\\\" \\\"courier=\\\"\\\" new\\\",=\\\"\\\" monospace;=\\\"\\\" font-size:=\\\"\\\" 12px;=\\\"\\\" white-space-collapse:=\\\"\\\" preserve;\\\"=\\\"\\\">문의하기</span>\",\"className\":\"submit btn-default btn\",\"name\":\"button-1770104904862-0\",\"access\":false,\"style\":\"default\"}]', '2026-03-05 11:55:01', '2026-03-05 11:55:01', NULL, 'ko'),
(124, 'CONTACT_US', '문의하기', '525669315@qq.com', '신규문의가 접수되었습니다', 1, 30, '[{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">업체명</span>\",\"placeholder\":\"개인 고객일 시 개인으로 기재해주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678090952-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">지역(도)</span>\",\"placeholder\":\"지역을 간략히 적어주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678528736-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">이름/직함</span>\",\"placeholder\":\"이름/직함을 적어주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678127422-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">연락처</span>\",\"placeholder\":\"- 없이 숫자만 적어주세요 \",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678151198-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"subtype\":\"email\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">이메일 주소</span>\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678181887-0\",\"access\":false},{\"type\":\"select\",\"required\":false,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">문의 서비스</span>\",\"className\":\"form-control col-sm-6\",\"name\":\"select-1772678714741-0\",\"access\":false,\"multiple\":false,\"values\":[{\"label\":\"중국 민원 서류\",\"value\":\"중국 민원 서류\",\"selected\":true},{\"label\":\"베트남 민원 서류\",\"value\":\"베트남 민원 서류\",\"selected\":false},{\"label\":\"전세계 대사관인증\",\"value\":\"전세계 대사관인증\",\"selected\":false},{\"label\":\"아포스티유\",\"value\":\"아포스티유\",\"selected\":false},{\"label\":\"공증 촉탁 대행\",\"value\":\"공증 촉탁 대행\",\"selected\":false},{\"label\":\"법인 빈원 서류\",\"value\":\"법인 빈원 서류\",\"selected\":false},{\"label\":\"해외 현지 서류\",\"value\":\"해외 현지 서류\",\"selected\":false},{\"label\":\"번역\",\"value\":\"번역\",\"selected\":false}]},{\"type\":\"textarea\",\"required\":false,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">기타 문의 및 요구사항</span>\",\"className\":\"form-group col-sm-12\",\"name\":\"textarea-1772679267069-0\",\"access\":false,\"subtype\":\"textarea\",\"rows\":5},{\"type\":\"paragraph\",\"subtype\":\"p\",\"label\":\"<span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">개인정보처리방침</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">1. 개인정보의 처리 목적</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">&lt;레드트랜스 비자 및 대사관인증 발급대행 서비스&gt;(‘http://redtrans.co.kr/’이하 ‘레드트랜스’)는 다음의 목적을 위하여 개인정보를 처리하고</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">있으며, 다음의 목적 이외의 용도로는 이용하지 않습니다.</span><br>\",\"className\":\"agreements\",\"access\":false},{\"type\":\"checkbox-group\",\"required\":true,\"toggle\":false,\"inline\":false,\"className\":\"col-sm-12 agree\",\"name\":\"checkbox-group-1772677119218-0\",\"access\":false,\"other\":false,\"values\":[{\"label\":\"개인정보처리방침에 동의합니다.\",\"value\":\"agree\",\"selected\":true}]},{\"type\":\"button\",\"subtype\":\"submit\",\"label\":\"<span style=\\\"color: rgb(31, 31, 31); font-family: consolas, \\\" lucida=\\\"\\\" console\\\",=\\\"\\\" \\\"courier=\\\"\\\" new\\\",=\\\"\\\" monospace;=\\\"\\\" font-size:=\\\"\\\" 12px;=\\\"\\\" white-space-collapse:=\\\"\\\" preserve;\\\"=\\\"\\\">문의하기</span>\",\"className\":\"submit btn-default btn\",\"name\":\"button-1770104904862-0\",\"access\":false,\"style\":\"default\"}]', '2026-03-05 11:55:14', '2026-03-05 11:55:14', NULL, 'ko'),
(125, 'CONTACT_US', '문의하기', '525669315@qq.com', '신규문의가 접수되었습니다', 1, 30, '[{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">업체명</span>\",\"placeholder\":\"개인 고객일 시 개인으로 기재해주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678090952-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">지역(도)</span>\",\"placeholder\":\"지역을 간략히 적어주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678528736-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">이름/직함</span>\",\"placeholder\":\"이름/직함을 적어주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678127422-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">연락처</span>\",\"placeholder\":\"- 없이 숫자만 적어주세요 \",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678151198-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"subtype\":\"email\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">이메일 주소</span>\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678181887-0\",\"access\":false},{\"type\":\"select\",\"required\":false,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">문의 서비스</span>\",\"className\":\"form-control col-sm-6\",\"name\":\"select-1772678714741-0\",\"access\":false,\"multiple\":false,\"values\":[{\"label\":\"중국 민원 서류\",\"value\":\"중국 민원 서류\",\"selected\":true},{\"label\":\"베트남 민원 서류\",\"value\":\"베트남 민원 서류\",\"selected\":false},{\"label\":\"전세계 대사관인증\",\"value\":\"전세계 대사관인증\",\"selected\":false},{\"label\":\"아포스티유\",\"value\":\"아포스티유\",\"selected\":false},{\"label\":\"공증 촉탁 대행\",\"value\":\"공증 촉탁 대행\",\"selected\":false},{\"label\":\"법인 빈원 서류\",\"value\":\"법인 빈원 서류\",\"selected\":false},{\"label\":\"해외 현지 서류\",\"value\":\"해외 현지 서류\",\"selected\":false},{\"label\":\"번역\",\"value\":\"번역\",\"selected\":false}]},{\"type\":\"textarea\",\"required\":false,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">기타 문의 및 요구사항</span>\",\"className\":\"form-group\",\"name\":\"textarea-1772679267069-0\",\"access\":false,\"subtype\":\"textarea\",\"rows\":5},{\"type\":\"paragraph\",\"subtype\":\"p\",\"label\":\"<span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">개인정보처리방침</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">1. 개인정보의 처리 목적</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">&lt;레드트랜스 비자 및 대사관인증 발급대행 서비스&gt;(‘http://redtrans.co.kr/’이하 ‘레드트랜스’)는 다음의 목적을 위하여 개인정보를 처리하고</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">있으며, 다음의 목적 이외의 용도로는 이용하지 않습니다.</span><br>\",\"className\":\"agreements\",\"access\":false},{\"type\":\"checkbox-group\",\"required\":true,\"toggle\":false,\"inline\":false,\"className\":\"col-sm-12 agree\",\"name\":\"checkbox-group-1772677119218-0\",\"access\":false,\"other\":false,\"values\":[{\"label\":\"개인정보처리방침에 동의합니다.\",\"value\":\"agree\",\"selected\":true}]},{\"type\":\"button\",\"subtype\":\"submit\",\"label\":\"<span style=\\\"color: rgb(31, 31, 31); font-family: consolas, \\\" lucida=\\\"\\\" console\\\",=\\\"\\\" \\\"courier=\\\"\\\" new\\\",=\\\"\\\" monospace;=\\\"\\\" font-size:=\\\"\\\" 12px;=\\\"\\\" white-space-collapse:=\\\"\\\" preserve;\\\"=\\\"\\\">문의하기</span>\",\"className\":\"submit btn-default btn\",\"name\":\"button-1770104904862-0\",\"access\":false,\"style\":\"default\"}]', '2026-03-05 11:55:43', '2026-03-05 11:55:43', NULL, 'ko'),
(126, 'CONTACT_US', '문의하기', '525669315@qq.com', '신규문의가 접수되었습니다', 1, 31, '[{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">업체명</span>\",\"placeholder\":\"개인 고객일 시 개인으로 기재해주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678090952-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">지역(도)</span>\",\"placeholder\":\"지역을 간략히 적어주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678528736-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">이름/직함</span>\",\"placeholder\":\"이름/직함을 적어주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678127422-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">연락처</span>\",\"placeholder\":\"- 없이 숫자만 적어주세요 \",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678151198-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"subtype\":\"email\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">이메일 주소</span>\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678181887-0\",\"access\":false},{\"type\":\"select\",\"required\":false,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">문의 서비스</span>\",\"className\":\"form-control col-sm-6\",\"name\":\"select-1772678714741-0\",\"access\":false,\"multiple\":false,\"values\":[{\"label\":\"중국 민원 서류\",\"value\":\"중국 민원 서류\",\"selected\":true},{\"label\":\"베트남 민원 서류\",\"value\":\"베트남 민원 서류\",\"selected\":false},{\"label\":\"전세계 대사관인증\",\"value\":\"전세계 대사관인증\",\"selected\":false},{\"label\":\"아포스티유\",\"value\":\"아포스티유\",\"selected\":false},{\"label\":\"공증 촉탁 대행\",\"value\":\"공증 촉탁 대행\",\"selected\":false},{\"label\":\"법인 빈원 서류\",\"value\":\"법인 빈원 서류\",\"selected\":false},{\"label\":\"해외 현지 서류\",\"value\":\"해외 현지 서류\",\"selected\":false},{\"label\":\"번역\",\"value\":\"번역\",\"selected\":false}]},{\"type\":\"textarea\",\"required\":false,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">기타 문의 및 요구사항</span>\",\"className\":\"form-group\",\"name\":\"textarea-1772679267069-0\",\"access\":false,\"subtype\":\"textarea\",\"rows\":5},{\"type\":\"paragraph\",\"subtype\":\"p\",\"label\":\"<span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">개인정보처리방침</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">1. 개인정보의 처리 목적</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">&lt;레드트랜스 비자 및 대사관인증 발급대행 서비스&gt;(‘http://redtrans.co.kr/’이하 ‘레드트랜스’)는 다음의 목적을 위하여 개인정보를 처리하고</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">있으며, 다음의 목적 이외의 용도로는 이용하지 않습니다.</span><br>\",\"className\":\"agreements\",\"access\":false},{\"type\":\"checkbox-group\",\"required\":true,\"toggle\":false,\"inline\":false,\"className\":\"col-sm-12 agree\",\"name\":\"checkbox-group-1772677119218-0\",\"access\":false,\"other\":false,\"values\":[{\"label\":\"개인정보처리방침에 동의합니다.\",\"value\":\"agree\",\"selected\":true}]},{\"type\":\"button\",\"subtype\":\"submit\",\"label\":\"<span style=\\\"color: rgb(31, 31, 31); font-family: consolas, \\\" lucida=\\\"\\\" console\\\",=\\\"\\\" \\\"courier=\\\"\\\" new\\\",=\\\"\\\" monospace;=\\\"\\\" font-size:=\\\"\\\" 12px;=\\\"\\\" white-space-collapse:=\\\"\\\" preserve;\\\"=\\\"\\\">문의하기</span>\",\"className\":\"submit btn-default btn\",\"name\":\"button-1770104904862-0\",\"access\":false,\"style\":\"default\"}]', '2026-03-05 11:55:52', '2026-03-05 11:55:52', NULL, 'ko'),
(127, 'CONTACT_US', '문의하기', '525669315@qq.com', '신규문의가 접수되었습니다', 1, 29, '[{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">업체명</span>\",\"placeholder\":\"개인 고객일 시 개인으로 기재해주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678090952-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">지역(도)</span>\",\"placeholder\":\"지역을 간략히 적어주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678528736-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">이름/직함</span>\",\"placeholder\":\"이름/직함을 적어주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678127422-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">연락처</span>\",\"placeholder\":\"- 없이 숫자만 적어주세요 \",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678151198-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"subtype\":\"email\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">이메일 주소</span>\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678181887-0\",\"access\":false},{\"type\":\"select\",\"required\":false,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">문의 서비스</span>\",\"className\":\"form-control col-sm-6\",\"name\":\"select-1772678714741-0\",\"access\":false,\"multiple\":false,\"values\":[{\"label\":\"중국 민원 서류\",\"value\":\"중국 민원 서류\",\"selected\":true},{\"label\":\"베트남 민원 서류\",\"value\":\"베트남 민원 서류\",\"selected\":false},{\"label\":\"전세계 대사관인증\",\"value\":\"전세계 대사관인증\",\"selected\":false},{\"label\":\"아포스티유\",\"value\":\"아포스티유\",\"selected\":false},{\"label\":\"공증 촉탁 대행\",\"value\":\"공증 촉탁 대행\",\"selected\":false},{\"label\":\"법인 빈원 서류\",\"value\":\"법인 빈원 서류\",\"selected\":false},{\"label\":\"해외 현지 서류\",\"value\":\"해외 현지 서류\",\"selected\":false},{\"label\":\"번역\",\"value\":\"번역\",\"selected\":false}]},{\"type\":\"textarea\",\"required\":false,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">기타 문의 및 요구사항</span>\",\"className\":\"form-control\",\"name\":\"textarea-1772678587116-0\",\"access\":false,\"subtype\":\"textarea\",\"rows\":5},{\"type\":\"paragraph\",\"subtype\":\"p\",\"label\":\"<span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">개인정보처리방침</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">1. 개인정보의 처리 목적</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">&lt;레드트랜스 비자 및 대사관인증 발급대행 서비스&gt;(‘http://redtrans.co.kr/’이하 ‘레드트랜스’)는 다음의 목적을 위하여 개인정보를 처리하고</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">있으며, 다음의 목적 이외의 용도로는 이용하지 않습니다.</span><br>\",\"className\":\"agreements\",\"access\":false},{\"type\":\"checkbox-group\",\"required\":true,\"toggle\":false,\"inline\":false,\"className\":\"col-sm-12 agree\",\"name\":\"checkbox-group-1772677119218-0\",\"access\":false,\"other\":false,\"values\":[{\"label\":\"개인정보처리방침에 동의합니다.\",\"value\":\"agree\",\"selected\":true}]},{\"type\":\"button\",\"subtype\":\"submit\",\"label\":\"<span style=\\\"color: rgb(31, 31, 31); font-family: consolas, \\\" lucida=\\\"\\\" console\\\",=\\\"\\\" \\\"courier=\\\"\\\" new\\\",=\\\"\\\" monospace;=\\\"\\\" font-size:=\\\"\\\" 12px;=\\\"\\\" white-space-collapse:=\\\"\\\" preserve;\\\"=\\\"\\\">문의하기</span>\",\"className\":\"submit btn-default btn\",\"name\":\"button-1770104904862-0\",\"access\":false,\"style\":\"default\"}]', '2026-03-05 11:56:22', '2026-03-05 11:56:22', NULL, 'ko'),
(128, 'CONTACT_US', '문의하기', '525669315@qq.com', '신규문의가 접수되었습니다', 1, 29, '[{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">업체명</span>\",\"placeholder\":\"개인 고객일 시 개인으로 기재해주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678090952-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">지역(도)</span>\",\"placeholder\":\"지역을 간략히 적어주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678528736-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">이름/직함</span>\",\"placeholder\":\"이름/직함을 적어주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678127422-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">연락처</span>\",\"placeholder\":\"- 없이 숫자만 적어주세요 \",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678151198-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"subtype\":\"email\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">이메일 주소</span>\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678181887-0\",\"access\":false},{\"type\":\"select\",\"required\":false,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">문의 서비스</span>\",\"className\":\"form-control col-sm-6\",\"name\":\"select-1772678714741-0\",\"access\":false,\"multiple\":false,\"values\":[{\"label\":\"중국 민원 서류\",\"value\":\"중국 민원 서류\",\"selected\":true},{\"label\":\"베트남 민원 서류\",\"value\":\"베트남 민원 서류\",\"selected\":false},{\"label\":\"전세계 대사관인증\",\"value\":\"전세계 대사관인증\",\"selected\":false},{\"label\":\"아포스티유\",\"value\":\"아포스티유\",\"selected\":false},{\"label\":\"공증 촉탁 대행\",\"value\":\"공증 촉탁 대행\",\"selected\":false},{\"label\":\"법인 빈원 서류\",\"value\":\"법인 빈원 서류\",\"selected\":false},{\"label\":\"해외 현지 서류\",\"value\":\"해외 현지 서류\",\"selected\":false},{\"label\":\"번역\",\"value\":\"번역\",\"selected\":false}]},{\"type\":\"textarea\",\"required\":false,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">기타 문의 및 요구사항</span>\",\"className\":\"form-control\",\"name\":\"textarea-1772679417599-0\",\"access\":false,\"subtype\":\"textarea\",\"rows\":5},{\"type\":\"paragraph\",\"subtype\":\"p\",\"label\":\"<span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">개인정보처리방침</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">1. 개인정보의 처리 목적</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">&lt;레드트랜스 비자 및 대사관인증 발급대행 서비스&gt;(‘http://redtrans.co.kr/’이하 ‘레드트랜스’)는 다음의 목적을 위하여 개인정보를 처리하고</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">있으며, 다음의 목적 이외의 용도로는 이용하지 않습니다.</span><br>\",\"className\":\"agreements\",\"access\":false},{\"type\":\"checkbox-group\",\"required\":true,\"toggle\":false,\"inline\":false,\"className\":\"col-sm-12 agree\",\"name\":\"checkbox-group-1772677119218-0\",\"access\":false,\"other\":false,\"values\":[{\"label\":\"개인정보처리방침에 동의합니다.\",\"value\":\"agree\",\"selected\":true}]},{\"type\":\"button\",\"subtype\":\"submit\",\"label\":\"<span style=\\\"color: rgb(31, 31, 31); font-family: consolas, \\\" lucida=\\\"\\\" console\\\",=\\\"\\\" \\\"courier=\\\"\\\" new\\\",=\\\"\\\" monospace;=\\\"\\\" font-size:=\\\"\\\" 12px;=\\\"\\\" white-space-collapse:=\\\"\\\" preserve;\\\"=\\\"\\\">문의하기</span>\",\"className\":\"submit btn-default btn\",\"name\":\"button-1770104904862-0\",\"access\":false,\"style\":\"default\"}]', '2026-03-05 11:57:11', '2026-03-05 11:57:11', NULL, 'ko'),
(129, 'CONTACT_US', '문의하기', '525669315@qq.com', '신규문의가 접수되었습니다', 1, 32, '[{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">업체명</span>\",\"placeholder\":\"개인 고객일 시 개인으로 기재해주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678090952-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">지역(도)</span>\",\"placeholder\":\"지역을 간략히 적어주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678528736-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">이름/직함</span>\",\"placeholder\":\"이름/직함을 적어주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678127422-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">연락처</span>\",\"placeholder\":\"- 없이 숫자만 적어주세요 \",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678151198-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"subtype\":\"email\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">이메일 주소</span>\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678181887-0\",\"access\":false},{\"type\":\"select\",\"required\":false,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">문의 서비스</span>\",\"className\":\"form-control col-sm-6\",\"name\":\"select-1772678714741-0\",\"access\":false,\"multiple\":false,\"values\":[{\"label\":\"중국 민원 서류\",\"value\":\"중국 민원 서류\",\"selected\":true},{\"label\":\"베트남 민원 서류\",\"value\":\"베트남 민원 서류\",\"selected\":false},{\"label\":\"전세계 대사관인증\",\"value\":\"전세계 대사관인증\",\"selected\":false},{\"label\":\"아포스티유\",\"value\":\"아포스티유\",\"selected\":false},{\"label\":\"공증 촉탁 대행\",\"value\":\"공증 촉탁 대행\",\"selected\":false},{\"label\":\"법인 빈원 서류\",\"value\":\"법인 빈원 서류\",\"selected\":false},{\"label\":\"해외 현지 서류\",\"value\":\"해외 현지 서류\",\"selected\":false},{\"label\":\"번역\",\"value\":\"번역\",\"selected\":false}]},{\"type\":\"textarea\",\"required\":false,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">기타 문의 및 요구사항</span>\",\"className\":\"form-control\",\"name\":\"textarea-1772679267069-0\",\"access\":false,\"subtype\":\"textarea\",\"rows\":5},{\"type\":\"paragraph\",\"subtype\":\"p\",\"label\":\"<span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">개인정보처리방침</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">1. 개인정보의 처리 목적</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">&lt;레드트랜스 비자 및 대사관인증 발급대행 서비스&gt;(‘http://redtrans.co.kr/’이하 ‘레드트랜스’)는 다음의 목적을 위하여 개인정보를 처리하고</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">있으며, 다음의 목적 이외의 용도로는 이용하지 않습니다.</span><br>\",\"className\":\"agreements\",\"access\":false},{\"type\":\"checkbox-group\",\"required\":true,\"toggle\":false,\"inline\":false,\"className\":\"col-sm-12 agree\",\"name\":\"checkbox-group-1772677119218-0\",\"access\":false,\"other\":false,\"values\":[{\"label\":\"개인정보처리방침에 동의합니다.\",\"value\":\"agree\",\"selected\":true}]},{\"type\":\"button\",\"subtype\":\"submit\",\"label\":\"<span style=\\\"color: rgb(31, 31, 31); font-family: consolas, \\\" lucida=\\\"\\\" console\\\",=\\\"\\\" \\\"courier=\\\"\\\" new\\\",=\\\"\\\" monospace;=\\\"\\\" font-size:=\\\"\\\" 12px;=\\\"\\\" white-space-collapse:=\\\"\\\" preserve;\\\"=\\\"\\\">문의하기</span>\",\"className\":\"submit btn-default btn\",\"name\":\"button-1770104904862-0\",\"access\":false,\"style\":\"default\"}]', '2026-03-05 11:57:45', '2026-03-05 11:57:45', NULL, 'ko'),
(130, 'CONTACT_US', '문의하기', 'sales@redtrans.co.kr', '신규문의가 접수되었습니다', 1, 33, '[{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">업체명</span>\",\"placeholder\":\"개인 고객일 시 개인으로 기재해주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678090952-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">지역(도)</span>\",\"placeholder\":\"지역을 간략히 적어주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678528736-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">이름/직함</span>\",\"placeholder\":\"이름/직함을 적어주세요\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678127422-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">연락처</span>\",\"placeholder\":\"- 없이 숫자만 적어주세요 \",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678151198-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"subtype\":\"email\",\"required\":true,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">이메일 주소</span>\",\"className\":\"form-control col-sm-6\",\"name\":\"text-1772678181887-0\",\"access\":false},{\"type\":\"select\",\"required\":false,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">문의 서비스</span>\",\"className\":\"form-control col-sm-6\",\"name\":\"select-1772678714741-0\",\"access\":false,\"multiple\":false,\"values\":[{\"label\":\"중국 민원 서류\",\"value\":\"중국 민원 서류\",\"selected\":true},{\"label\":\"베트남 민원 서류\",\"value\":\"베트남 민원 서류\",\"selected\":false},{\"label\":\"전세계 대사관인증\",\"value\":\"전세계 대사관인증\",\"selected\":false},{\"label\":\"아포스티유\",\"value\":\"아포스티유\",\"selected\":false},{\"label\":\"공증 촉탁 대행\",\"value\":\"공증 촉탁 대행\",\"selected\":false},{\"label\":\"법인 빈원 서류\",\"value\":\"법인 빈원 서류\",\"selected\":false},{\"label\":\"해외 현지 서류\",\"value\":\"해외 현지 서류\",\"selected\":false},{\"label\":\"번역\",\"value\":\"번역\",\"selected\":false}]},{\"type\":\"textarea\",\"required\":false,\"label\":\"<span style=\\\"color: rgb(31, 31, 31);\\\">기타 문의 및 요구사항</span>\",\"className\":\"form-control\",\"name\":\"textarea-1772679267069-0\",\"access\":false,\"subtype\":\"textarea\",\"rows\":5},{\"type\":\"paragraph\",\"subtype\":\"p\",\"label\":\"<span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">개인정보처리방침</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">1. 개인정보의 처리 목적</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">&lt;레드트랜스 비자 및 대사관인증 발급대행 서비스&gt;(‘http://redtrans.co.kr/’이하 ‘레드트랜스’)는 다음의 목적을 위하여 개인정보를 처리하고</span><br style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif;\\\"><span style=\\\"color: rgb(51, 51, 51); font-family: Pretendard, sans-serif; background-color: rgb(249, 250, 252);\\\">있으며, 다음의 목적 이외의 용도로는 이용하지 않습니다.</span><br>\",\"className\":\"agreements\",\"access\":false},{\"type\":\"checkbox-group\",\"required\":true,\"toggle\":false,\"inline\":false,\"className\":\"col-sm-12 agree\",\"name\":\"checkbox-group-1772677119218-0\",\"access\":false,\"other\":false,\"values\":[{\"label\":\"개인정보처리방침에 동의합니다.\",\"value\":\"agree\",\"selected\":true}]},{\"type\":\"button\",\"subtype\":\"submit\",\"label\":\"<span style=\\\"color: rgb(31, 31, 31); font-family: consolas, \\\" lucida=\\\"\\\" console\\\",=\\\"\\\" \\\"courier=\\\"\\\" new\\\",=\\\"\\\" monospace;=\\\"\\\" font-size:=\\\"\\\" 12px;=\\\"\\\" white-space-collapse:=\\\"\\\" preserve;\\\"=\\\"\\\">문의하기</span>\",\"className\":\"submit btn-default btn\",\"name\":\"button-1770104904862-0\",\"access\":false,\"style\":\"default\"}]', '2026-04-14 14:04:37', '2026-04-14 14:04:37', NULL, 'ko');

-- --------------------------------------------------------

--
-- 表的结构 `form_fields`
--

CREATE TABLE `form_fields` (
  `id` int(11) NOT NULL,
  `form_code` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `label` varchar(100) DEFAULT NULL,
  `required` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `options` varchar(255) DEFAULT NULL,
  `validation` varchar(255) DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `version` int(11) DEFAULT NULL,
  `lang` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `form_fields`
--

INSERT INTO `form_fields` (`id`, `form_code`, `name`, `type`, `label`, `required`, `created_at`, `updated_at`, `options`, `validation`, `sequence`, `active`, `version`, `lang`) VALUES
(722, 'CONTACT_US', 'text-1772678090952-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">업체명</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 28, 'ko'),
(723, 'CONTACT_US', 'text-1772678528736-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">지역(도)</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 28, 'ko'),
(724, 'CONTACT_US', 'text-1772678127422-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">이름/직함</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 28, 'ko'),
(725, 'CONTACT_US', 'text-1772678151198-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">연락처</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 28, 'ko'),
(726, 'CONTACT_US', 'text-1772678181887-0', 'email', '<span style=\"color: rgb(31, 31, 31);\">이메일 주소</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 28, 'ko'),
(727, 'CONTACT_US', 'select-1772678714741-0', 'select', '<span style=\"color: rgb(31, 31, 31);\">문의 서비스</span>', 0, NULL, NULL, NULL, NULL, NULL, NULL, 28, 'ko'),
(728, 'CONTACT_US', 'textarea-1772678587116-0', 'textarea', '<span style=\"color: rgb(31, 31, 31);\">기타 문의 및 요구사항</span>', 0, NULL, NULL, NULL, NULL, NULL, NULL, 28, 'ko'),
(729, 'CONTACT_US', 'checkbox-group-1772677119218-0', 'checkbox-group', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 28, 'ko'),
(730, 'CONTACT_US', 'button-1770104904862-0', 'submit', '<span style=\"color: rgb(31, 31, 31); font-family: consolas, \" lucida=\"\" console\",=\"\" \"courier=\"\" new', 0, NULL, NULL, NULL, NULL, NULL, NULL, 28, 'ko'),
(731, 'CONTACT_US', 'text-1772678090952-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">업체명</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(732, 'CONTACT_US', 'text-1772678528736-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">지역(도)</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(733, 'CONTACT_US', 'text-1772678127422-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">이름/직함</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(734, 'CONTACT_US', 'text-1772678151198-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">연락처</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(735, 'CONTACT_US', 'text-1772678181887-0', 'email', '<span style=\"color: rgb(31, 31, 31);\">이메일 주소</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(736, 'CONTACT_US', 'select-1772678714741-0', 'select', '<span style=\"color: rgb(31, 31, 31);\">문의 서비스</span>', 0, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(737, 'CONTACT_US', 'textarea-1772678587116-0', 'textarea', '<span style=\"color: rgb(31, 31, 31);\">기타 문의 및 요구사항</span>', 0, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(738, 'CONTACT_US', 'checkbox-group-1772677119218-0', 'checkbox-group', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(739, 'CONTACT_US', 'button-1770104904862-0', 'submit', '<span style=\"color: rgb(31, 31, 31); font-family: consolas, \" lucida=\"\" console\",=\"\" \"courier=\"\" new', 0, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(740, 'CONTACT_US', 'text-1772678090952-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">업체명</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(741, 'CONTACT_US', 'text-1772678528736-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">지역(도)</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(742, 'CONTACT_US', 'text-1772678127422-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">이름/직함</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(743, 'CONTACT_US', 'text-1772678151198-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">연락처</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(744, 'CONTACT_US', 'text-1772678181887-0', 'email', '<span style=\"color: rgb(31, 31, 31);\">이메일 주소</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(745, 'CONTACT_US', 'select-1772678714741-0', 'select', '<span style=\"color: rgb(31, 31, 31);\">문의 서비스</span>', 0, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(746, 'CONTACT_US', 'textarea-1772679267069-0', 'textarea', '<span style=\"color: rgb(31, 31, 31);\">기타 문의 및 요구사항</span>', 0, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(747, 'CONTACT_US', 'checkbox-group-1772677119218-0', 'checkbox-group', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(748, 'CONTACT_US', 'button-1770104904862-0', 'submit', '<span style=\"color: rgb(31, 31, 31); font-family: consolas, \" lucida=\"\" console\",=\"\" \"courier=\"\" new', 0, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(749, 'CONTACT_US', 'text-1772678090952-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">업체명</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 30, 'ko'),
(750, 'CONTACT_US', 'text-1772678528736-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">지역(도)</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 30, 'ko'),
(751, 'CONTACT_US', 'text-1772678127422-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">이름/직함</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 30, 'ko'),
(752, 'CONTACT_US', 'text-1772678151198-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">연락처</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 30, 'ko'),
(753, 'CONTACT_US', 'text-1772678181887-0', 'email', '<span style=\"color: rgb(31, 31, 31);\">이메일 주소</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 30, 'ko'),
(754, 'CONTACT_US', 'select-1772678714741-0', 'select', '<span style=\"color: rgb(31, 31, 31);\">문의 서비스</span>', 0, NULL, NULL, NULL, NULL, NULL, NULL, 30, 'ko'),
(755, 'CONTACT_US', 'textarea-1772679267069-0', 'textarea', '<span style=\"color: rgb(31, 31, 31);\">기타 문의 및 요구사항</span>', 0, NULL, NULL, NULL, NULL, NULL, NULL, 30, 'ko'),
(756, 'CONTACT_US', 'checkbox-group-1772677119218-0', 'checkbox-group', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 30, 'ko'),
(757, 'CONTACT_US', 'button-1770104904862-0', 'submit', '<span style=\"color: rgb(31, 31, 31); font-family: consolas, \" lucida=\"\" console\",=\"\" \"courier=\"\" new', 0, NULL, NULL, NULL, NULL, NULL, NULL, 30, 'ko'),
(758, 'CONTACT_US', 'text-1772678090952-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">업체명</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 30, 'ko'),
(759, 'CONTACT_US', 'text-1772678528736-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">지역(도)</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 30, 'ko'),
(760, 'CONTACT_US', 'text-1772678127422-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">이름/직함</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 30, 'ko'),
(761, 'CONTACT_US', 'text-1772678151198-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">연락처</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 30, 'ko'),
(762, 'CONTACT_US', 'text-1772678181887-0', 'email', '<span style=\"color: rgb(31, 31, 31);\">이메일 주소</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 30, 'ko'),
(763, 'CONTACT_US', 'select-1772678714741-0', 'select', '<span style=\"color: rgb(31, 31, 31);\">문의 서비스</span>', 0, NULL, NULL, NULL, NULL, NULL, NULL, 30, 'ko'),
(764, 'CONTACT_US', 'textarea-1772679267069-0', 'textarea', '<span style=\"color: rgb(31, 31, 31);\">기타 문의 및 요구사항</span>', 0, NULL, NULL, NULL, NULL, NULL, NULL, 30, 'ko'),
(765, 'CONTACT_US', 'checkbox-group-1772677119218-0', 'checkbox-group', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 30, 'ko'),
(766, 'CONTACT_US', 'button-1770104904862-0', 'submit', '<span style=\"color: rgb(31, 31, 31); font-family: consolas, \" lucida=\"\" console\",=\"\" \"courier=\"\" new', 0, NULL, NULL, NULL, NULL, NULL, NULL, 30, 'ko'),
(767, 'CONTACT_US', 'text-1772678090952-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">업체명</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 31, 'ko'),
(768, 'CONTACT_US', 'text-1772678528736-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">지역(도)</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 31, 'ko'),
(769, 'CONTACT_US', 'text-1772678127422-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">이름/직함</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 31, 'ko'),
(770, 'CONTACT_US', 'text-1772678151198-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">연락처</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 31, 'ko'),
(771, 'CONTACT_US', 'text-1772678181887-0', 'email', '<span style=\"color: rgb(31, 31, 31);\">이메일 주소</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 31, 'ko'),
(772, 'CONTACT_US', 'select-1772678714741-0', 'select', '<span style=\"color: rgb(31, 31, 31);\">문의 서비스</span>', 0, NULL, NULL, NULL, NULL, NULL, NULL, 31, 'ko'),
(773, 'CONTACT_US', 'textarea-1772679267069-0', 'textarea', '<span style=\"color: rgb(31, 31, 31);\">기타 문의 및 요구사항</span>', 0, NULL, NULL, NULL, NULL, NULL, NULL, 31, 'ko'),
(774, 'CONTACT_US', 'checkbox-group-1772677119218-0', 'checkbox-group', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 31, 'ko'),
(775, 'CONTACT_US', 'button-1770104904862-0', 'submit', '<span style=\"color: rgb(31, 31, 31); font-family: consolas, \" lucida=\"\" console\",=\"\" \"courier=\"\" new', 0, NULL, NULL, NULL, NULL, NULL, NULL, 31, 'ko'),
(776, 'CONTACT_US', 'text-1772678090952-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">업체명</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(777, 'CONTACT_US', 'text-1772678528736-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">지역(도)</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(778, 'CONTACT_US', 'text-1772678127422-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">이름/직함</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(779, 'CONTACT_US', 'text-1772678151198-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">연락처</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(780, 'CONTACT_US', 'text-1772678181887-0', 'email', '<span style=\"color: rgb(31, 31, 31);\">이메일 주소</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(781, 'CONTACT_US', 'select-1772678714741-0', 'select', '<span style=\"color: rgb(31, 31, 31);\">문의 서비스</span>', 0, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(782, 'CONTACT_US', 'textarea-1772678587116-0', 'textarea', '<span style=\"color: rgb(31, 31, 31);\">기타 문의 및 요구사항</span>', 0, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(783, 'CONTACT_US', 'checkbox-group-1772677119218-0', 'checkbox-group', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(784, 'CONTACT_US', 'button-1770104904862-0', 'submit', '<span style=\"color: rgb(31, 31, 31); font-family: consolas, \" lucida=\"\" console\",=\"\" \"courier=\"\" new', 0, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(785, 'CONTACT_US', 'text-1772678090952-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">업체명</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(786, 'CONTACT_US', 'text-1772678528736-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">지역(도)</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(787, 'CONTACT_US', 'text-1772678127422-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">이름/직함</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(788, 'CONTACT_US', 'text-1772678151198-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">연락처</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(789, 'CONTACT_US', 'text-1772678181887-0', 'email', '<span style=\"color: rgb(31, 31, 31);\">이메일 주소</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(790, 'CONTACT_US', 'select-1772678714741-0', 'select', '<span style=\"color: rgb(31, 31, 31);\">문의 서비스</span>', 0, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(791, 'CONTACT_US', 'textarea-1772679417599-0', 'textarea', '<span style=\"color: rgb(31, 31, 31);\">기타 문의 및 요구사항</span>', 0, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(792, 'CONTACT_US', 'checkbox-group-1772677119218-0', 'checkbox-group', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(793, 'CONTACT_US', 'button-1770104904862-0', 'submit', '<span style=\"color: rgb(31, 31, 31); font-family: consolas, \" lucida=\"\" console\",=\"\" \"courier=\"\" new', 0, NULL, NULL, NULL, NULL, NULL, NULL, 29, 'ko'),
(794, 'CONTACT_US', 'text-1772678090952-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">업체명</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 32, 'ko'),
(795, 'CONTACT_US', 'text-1772678528736-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">지역(도)</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 32, 'ko'),
(796, 'CONTACT_US', 'text-1772678127422-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">이름/직함</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 32, 'ko'),
(797, 'CONTACT_US', 'text-1772678151198-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">연락처</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 32, 'ko'),
(798, 'CONTACT_US', 'text-1772678181887-0', 'email', '<span style=\"color: rgb(31, 31, 31);\">이메일 주소</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 32, 'ko'),
(799, 'CONTACT_US', 'select-1772678714741-0', 'select', '<span style=\"color: rgb(31, 31, 31);\">문의 서비스</span>', 0, NULL, NULL, NULL, NULL, NULL, NULL, 32, 'ko'),
(800, 'CONTACT_US', 'textarea-1772679267069-0', 'textarea', '<span style=\"color: rgb(31, 31, 31);\">기타 문의 및 요구사항</span>', 0, NULL, NULL, NULL, NULL, NULL, NULL, 32, 'ko'),
(801, 'CONTACT_US', 'checkbox-group-1772677119218-0', 'checkbox-group', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 32, 'ko'),
(802, 'CONTACT_US', 'button-1770104904862-0', 'submit', '<span style=\"color: rgb(31, 31, 31); font-family: consolas, \" lucida=\"\" console\",=\"\" \"courier=\"\" new', 0, NULL, NULL, NULL, NULL, NULL, NULL, 32, 'ko'),
(803, 'CONTACT_US', 'text-1772678090952-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">업체명</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 33, 'ko'),
(804, 'CONTACT_US', 'text-1772678528736-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">지역(도)</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 33, 'ko'),
(805, 'CONTACT_US', 'text-1772678127422-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">이름/직함</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 33, 'ko'),
(806, 'CONTACT_US', 'text-1772678151198-0', 'text', '<span style=\"color: rgb(31, 31, 31);\">연락처</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 33, 'ko'),
(807, 'CONTACT_US', 'text-1772678181887-0', 'email', '<span style=\"color: rgb(31, 31, 31);\">이메일 주소</span>', 1, NULL, NULL, NULL, NULL, NULL, NULL, 33, 'ko'),
(808, 'CONTACT_US', 'select-1772678714741-0', 'select', '<span style=\"color: rgb(31, 31, 31);\">문의 서비스</span>', 0, NULL, NULL, NULL, NULL, NULL, NULL, 33, 'ko'),
(809, 'CONTACT_US', 'textarea-1772679267069-0', 'textarea', '<span style=\"color: rgb(31, 31, 31);\">기타 문의 및 요구사항</span>', 0, NULL, NULL, NULL, NULL, NULL, NULL, 33, 'ko'),
(810, 'CONTACT_US', 'checkbox-group-1772677119218-0', 'checkbox-group', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 33, 'ko'),
(811, 'CONTACT_US', 'button-1770104904862-0', 'submit', '<span style=\"color: rgb(31, 31, 31); font-family: consolas, \" lucida=\"\" console\",=\"\" \"courier=\"\" new', 0, NULL, NULL, NULL, NULL, NULL, NULL, 33, 'ko');

-- --------------------------------------------------------

--
-- 表的结构 `form_submit`
--

CREATE TABLE `form_submit` (
  `id` int(11) NOT NULL,
  `form_code` varchar(255) NOT NULL,
  `data` longtext NOT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `created_at` datetime DEFAULT NULL,
  `version` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `view_count` int(11) DEFAULT NULL,
  `lang` varchar(255) DEFAULT NULL,
  `send_status` int(1) DEFAULT NULL COMMENT '发送状态：发送成功1 发送失败0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `form_submit`
--

INSERT INTO `form_submit` (`id`, `form_code`, `data`, `ip`, `user_agent`, `created_at`, `version`, `created_by`, `updated_at`, `view_count`, `lang`, `send_status`) VALUES
(41, 'contact_us', '{\"text-1772678090952-0\":\"21321321\",\"text-1772678528736-0\":\"321321\",\"text-1772678127422-0\":\"321321\",\"text-1772678151198-0\":\"321321\",\"text-1772678181887-0\":\"525669315@qq.com\",\"select-1772678714741-0\":\"전세계 대사관인증\",\"textarea-1772679267069-0\":\"213213\",\"checkbox-group-1772677119218-0\":[\"agree\"]}', '121.170.203.142', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2026-03-05 12:23:24', 32, 94, '2026-03-05 12:23:37', 1, 'ko', NULL),
(42, 'contact_us', '{\"text-1772678090952-0\":\"21321321\",\"text-1772678528736-0\":\"3213213\",\"text-1772678127422-0\":\"2132132\",\"text-1772678151198-0\":\"132132123213\",\"text-1772678181887-0\":\"525669315@qq.com\",\"select-1772678714741-0\":\"법인 빈원 서류\",\"textarea-1772679267069-0\":\"1321321\",\"checkbox-group-1772677119218-0\":[\"agree\"]}', '121.170.203.142', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.1', '2026-03-05 15:58:07', 32, 94, '2026-03-25 17:49:49', 1, 'ko', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `trans_id` int(11) DEFAULT NULL,
  `trans_type` varchar(255) DEFAULT NULL,
  `lang` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `content` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `languages`
--

INSERT INTO `languages` (`id`, `trans_id`, `trans_type`, `lang`, `title`, `subject`, `description`, `content`) VALUES
(19, 65, 'navigation', 'ko', '회사 개요', NULL, '', NULL),
(20, 73, 'navigation', 'ko', 'OEM제품', 'OEM', '', NULL),
(21, 70, 'navigation', 'ko', 'OEM제품', 'OEM / ODM', '', NULL),
(22, 76, 'navigation', 'ko', '공지사항', 'notice', '', NULL),
(23, 64, 'navigation', 'en', 'Company Introduction', '', '', NULL),
(24, 65, 'navigation', 'en', 'Company Introduction', 'Introduction', '', NULL),
(25, 66, 'navigation', 'en', 'CEO Greetings', 'CEO Message', '', NULL),
(26, 67, 'navigation', 'en', 'Company History', 'History', '', NULL),
(27, 68, 'navigation', 'en', 'Directions', 'Location', '', NULL),
(28, 69, 'navigation', 'en', 'Service Introduction', '', '', NULL),
(29, 70, 'navigation', 'en', 'OEM / ODM', 'OEM / ODM', '', NULL),
(30, 71, 'navigation', 'en', 'echnology Certification Status', 'Technology', '', NULL),
(31, 72, 'navigation', 'en', 'Product Introduction', '', '', NULL),
(32, 73, 'navigation', 'en', 'OEM Products', 'OEM Products', '', NULL),
(33, 74, 'navigation', 'en', 'Naturepos Products', 'Naturepos Products', '', NULL),
(34, 75, 'navigation', 'en', 'Customer Support', '', '', NULL),
(35, 76, 'navigation', 'en', 'Notice', 'Notice', '', NULL),
(36, 77, 'navigation', 'en', 'OEM / ODM Inquiry', 'Inquiry', '', NULL),
(37, 64, 'navigation', 'vn', 'Giới thiệu công ty', '', '', NULL),
(38, 65, 'navigation', 'vn', 'Tổng quan công ty', 'Introduction', '', NULL),
(39, 66, 'navigation', 'vn', 'Thông điệp CEO', 'CEO Message', '', NULL),
(40, 67, 'navigation', 'vn', 'Lịch sử công ty', 'History', '', NULL),
(41, 68, 'navigation', 'ko', 'Chỉ đường', 'Location', '', NULL),
(42, 69, 'navigation', 'vn', 'Giới thiệu dịch vụ', '', '', NULL),
(43, 70, 'navigation', 'vn', 'OEM / ODM', 'OEM / ODM', '', NULL),
(44, 71, 'navigation', 'vn', 'Tình trạng chứng nhận công nghệ', 'Technology', '', NULL),
(45, 72, 'navigation', 'vn', 'Giới thiệu sản phẩm', '', '', NULL),
(46, 73, 'navigation', 'vn', 'Sản phẩm OEM', 'OEM Products', '', NULL),
(47, 74, 'navigation', 'vn', 'Sản phẩm công ty', 'Naturepos Products', '', NULL),
(48, 75, 'navigation', 'vn', 'Hỗ trợ khách hàng', '', '', NULL),
(49, 76, 'navigation', 'vn', 'Thông báo', 'Notice', '', NULL),
(50, 77, 'navigation', 'vn', 'Yêu cầu OEM / ODM', 'Inquiry', '', NULL),
(51, 68, 'navigation', 'vn', 'Chỉ đường', 'Location', '', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `original_name` varchar(255) DEFAULT NULL,
  `extension` varchar(20) DEFAULT NULL,
  `mime` varchar(100) DEFAULT NULL,
  `size` bigint(20) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `type_group` varchar(255) DEFAULT NULL,
  `upload_token` varchar(64) DEFAULT NULL,
  `is_used` tinyint(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `public` tinyint(1) UNSIGNED ZEROFILL DEFAULT NULL COMMENT '文件保护 1公开 0非公开'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `media`
--

INSERT INTO `media` (`id`, `path`, `original_name`, `extension`, `mime`, `size`, `width`, `height`, `type_group`, `upload_token`, `is_used`, `created_by`, `created_at`, `updated_at`, `public`) VALUES
(547, 'uploads/images/2026/02/02/1770002193_5776e05a59a4cd8dea55.jpg', 'home-slide-1-bg.jpg', 'jpg', 'image/jpeg', 1409706, 2560, 1350, 'images', 'b1ee6e4faa2cc659427f6cd5d51ab8f8', 0, 94, '2026-02-02 12:16:33', '2026-02-02 12:31:01', 1),
(548, 'uploads/images/2026/02/02/1770003025_472ac10a5a440c5c35ee.jpg', 'home-slide-2-bg.jpg', 'jpg', 'image/jpeg', 2476693, 2560, 1350, 'images', '85c03770dc956839d9d534a978464d15', 0, 94, '2026-02-02 12:30:25', '2026-03-02 12:35:31', 1),
(549, 'uploads/images/2026/02/02/1770003031_5e8941a37d0de0a589ba.jpg', 'home-slide-3-bg.jpg', 'jpg', 'image/jpeg', 2216154, 2560, 1350, 'images', '85c03770dc956839d9d534a978464d15', 0, 94, '2026-02-02 12:30:31', '2026-03-02 12:35:31', 1),
(550, 'uploads/images/2026/02/03/1770081968_fc202f16b87ed1cce2ab.png', '깊은산마음심_제품페이지.png', 'png', 'image/png', 932689, 1280, 720, 'images', '449169f892ceaff9efbe3b07acfcac90', 1, 94, '2026-02-03 10:26:08', '2026-02-03 10:26:41', 1),
(551, 'uploads/images/2026/02/03/1770082493_8665f29c50c0709c497a.jpg', '라온차_제품썸네일-600x400.jpg', 'jpg', 'image/jpeg', 29885, 600, 400, 'images', '355c61690f52c8668cfca66c234a54e6', 0, 94, '2026-02-03 10:34:53', '2026-02-03 10:34:53', 1),
(552, 'uploads/images/2026/02/03/1770082606_a0aff97701d1010a79f8.jpg', '라온차_제품썸네일-600x400.jpg', 'jpg', 'image/jpeg', 29885, 600, 400, 'images', '95b296b4c81877ed3944451eaa3edb66', 1, 94, '2026-02-03 10:36:46', '2026-02-03 10:36:54', 1),
(553, 'uploads/images/2026/02/03/1770082730_047a1a7b6a30094a8038.png', '보람차-제품페이지.png', 'png', 'image/png', 433698, 1280, 720, 'images', '853e727192e5b8835260f18d45c07752', 1, 94, '2026-02-03 10:38:50', '2026-02-03 10:39:10', 1),
(554, 'uploads/images/2026/02/03/1770102422_1b64140d620198ca70c2.png', '썸네일.png', 'png', 'image/png', 1938038, 1280, 720, 'images', '77e0cade9c0c3012298ff39cfc93149c', 0, 94, '2026-02-03 16:07:02', '2026-02-03 16:11:17', 1),
(555, 'uploads/images/2026/02/03/1770102560_e5c31cba9237c45d6d4c.jpg', '사포닌900_제품페이지썸네일.jpg', 'jpg', 'image/jpeg', 143512, 1270, 720, 'images', '9fddad8069abc9bd044592b5aa9f748d', 0, 94, '2026-02-03 16:09:20', '2026-02-03 16:09:20', 1),
(556, 'uploads/images/2026/02/03/1770102595_39dbd015c9ec5835149f.jpg', '사포닌900_제품페이지썸네일.jpg', 'jpg', 'image/jpeg', 143512, 1270, 720, 'images', 'e87425aece61f586e60f9fd4c68fbc70', 1, 94, '2026-02-03 16:09:55', '2026-02-03 16:09:57', 1),
(557, 'uploads/images/2026/02/03/1770102676_60f0634c255b000dca23.jpg', '나홍삼_08 (2).jpg', 'jpg', 'image/jpeg', 235319, 1280, 720, 'images', '096a62ae36c25c937732540f5a9b483b', 1, 94, '2026-02-03 16:11:16', '2026-02-03 16:11:17', 1),
(558, 'uploads/images/2026/02/03/1770102708_4be70d49362b596df2ca.png', '썸네일.png', 'png', 'image/png', 1938038, 1280, 720, 'images', 'bbc4ba22b03c1ece21e63fbb6e55bfb0', 1, 94, '2026-02-03 16:11:48', '2026-02-03 16:12:11', 1),
(559, 'uploads/images/2026/02/03/1770107051_a663f29ebcb1bb76e908.jpg', 'home-slide-1-bg.jpg', 'jpg', 'image/jpeg', 1409706, 2560, 1350, 'images', '44874e04b5c4f4ea489a24440fd4a778', 0, 94, '2026-02-03 17:24:11', '2026-02-03 17:24:11', 1),
(560, 'uploads/images/2026/02/03/1770107059_0dea6470fe8d7d8efafe.jpg', 'home-slide-2-bg.jpg', 'jpg', 'image/jpeg', 2476693, 2560, 1350, 'images', '44874e04b5c4f4ea489a24440fd4a778', 0, 94, '2026-02-03 17:24:19', '2026-02-03 17:24:19', 1),
(561, 'uploads/images/2026/02/03/1770107064_3a1bb99e1c24949fcb29.jpg', 'home-slide-3-bg.jpg', 'jpg', 'image/jpeg', 2216154, 2560, 1350, 'images', '44874e04b5c4f4ea489a24440fd4a778', 0, 94, '2026-02-03 17:24:24', '2026-02-03 17:24:24', 1),
(562, 'uploads/images/2026/02/03/1770107274_31af29d840c4c47eb2a8.jpg', 'home-slide-1-bg.jpg', 'jpg', 'image/jpeg', 1409706, 2560, 1350, 'images', '631418c7e64f55fd2937e77119640ef5', 1, 94, '2026-02-03 17:27:54', '2026-02-03 17:28:26', 1),
(563, 'uploads/images/2026/02/03/1770107279_4ddbb60982caf7929436.jpg', 'home-slide-2-bg.jpg', 'jpg', 'image/jpeg', 2476693, 2560, 1350, 'images', '631418c7e64f55fd2937e77119640ef5', 1, 94, '2026-02-03 17:27:59', '2026-02-03 17:28:26', 1),
(564, 'uploads/images/2026/02/03/1770107284_a2b96f4dd24af0af4891.jpg', 'home-slide-2-bg.jpg', 'jpg', 'image/jpeg', 2476693, 2560, 1350, 'images', '631418c7e64f55fd2937e77119640ef5', 1, 94, '2026-02-03 17:28:04', '2026-02-03 17:28:26', 1),
(565, 'uploads/images/2026/02/03/1770107321_687ec1f7df35db2cd8f0.jpg', 'home-slide-1-bg.jpg', 'jpg', 'image/jpeg', 1409706, 2560, 1350, 'images', '9fff143ef5fba8f1ad9ae79c8b884fd5', 1, 94, '2026-02-03 17:28:41', '2026-02-03 17:29:37', 1),
(566, 'uploads/images/2026/02/03/1770107326_ea8549fa5da7dc7a5f9d.jpg', 'home-slide-2-bg.jpg', 'jpg', 'image/jpeg', 2476693, 2560, 1350, 'images', '9fff143ef5fba8f1ad9ae79c8b884fd5', 1, 94, '2026-02-03 17:28:46', '2026-02-03 17:29:37', 1),
(567, 'uploads/images/2026/02/03/1770107331_da4649d67a4612625bee.jpg', 'home-slide-3-bg.jpg', 'jpg', 'image/jpeg', 2216154, 2560, 1350, 'images', '9fff143ef5fba8f1ad9ae79c8b884fd5', 1, 94, '2026-02-03 17:28:51', '2026-02-03 17:29:37', 1),
(568, 'uploads/images/2026/02/03/1770109149_89ded48b3f95ec2eed6a.jpg', 'cropped_image.jpg', 'jpg', 'image/jpeg', 31849, 488, 255, 'images', '8e2aa628c42b877e01dc7a54249c017e', 0, 94, '2026-02-03 17:59:09', '2026-02-03 17:59:09', 1),
(569, 'uploads/images/2026/02/03/1770109189_89856b9fd90a8a58b074.jpg', 'cropped_image.jpg', 'jpg', 'image/jpeg', 31835, 488, 255, 'images', '3db41f6e63226ca6054b15d9e4387914', 0, 94, '2026-02-03 17:59:49', '2026-02-03 17:59:49', 1),
(570, 'uploads/images/2026/02/03/1770109338_ce36a701a25ddfe6e442.jpg', 'cropped_image.jpg', 'jpg', 'image/jpeg', 31848, 488, 255, 'images', '355d303b2f5f8d54ed8c4d0d1e78c3b3', 0, 94, '2026-02-03 18:02:18', '2026-02-03 18:02:18', 1),
(571, 'uploads/images/2026/02/04/1770171837_e5912a8f4bace8d36693.jpg', 'cropped_image.jpg', 'jpg', 'image/jpeg', 1391, 32, 32, 'images', '3832906a77017f75e2340203fffe92cc', 0, 94, '2026-02-04 11:23:57', '2026-02-04 11:23:57', 1),
(572, 'uploads/images/2026/02/04/1770171927_f6cffe17289d1637edc1.jpg', 'cropped_image.jpg', 'jpg', 'image/jpeg', 1393, 32, 32, 'images', '4e4269bf94aa15748dd3c0e42845fb8c', 0, 94, '2026-02-04 11:25:27', '2026-02-04 11:25:27', 1),
(573, 'uploads/images/2026/02/04/1770171928_35c7cb455862a32417bf.jpg', 'cropped_image.jpg', 'jpg', 'image/jpeg', 1393, 32, 32, 'images', '4e4269bf94aa15748dd3c0e42845fb8c', 0, 94, '2026-02-04 11:25:28', '2026-02-04 11:25:28', 1),
(574, 'uploads/images/2026/02/04/1770171936_45f85b95ee4d56d4d609.jpg', 'cropped_image.jpg', 'jpg', 'image/jpeg', 1393, 32, 32, 'images', '4e4269bf94aa15748dd3c0e42845fb8c', 0, 94, '2026-02-04 11:25:36', '2026-02-04 11:25:36', 1),
(575, 'uploads/images/2026/02/04/1770172062_3f2783f452a704157ecb.png', 'bc627df6-7f60-423c-aa34-6af11297fe17.png', 'png', 'image/png', 1717, 54, 54, 'images', 'f1b1e8caa7e0e44acbb73ae80e01b486', 0, 94, '2026-02-04 11:27:42', '2026-02-04 11:27:42', 1),
(576, 'uploads/images/2026/02/04/1770172078_2847febd3e0aa08d916b.png', 'bc627df6-7f60-423c-aa34-6af11297fe17.png', 'png', 'image/png', 1717, 54, 54, 'images', 'e04fe645014d87fb0dc28119a7e757ba', 0, 94, '2026-02-04 11:27:58', '2026-02-04 11:27:58', 1),
(577, 'uploads/images/2026/02/25/1771982213_6c3aca76b82ae8580afb.jpg', 'cropped_image.jpg', 'jpg', 'image/jpeg', 8119, 172, 172, 'images', '594892bac94d59354f293815d77e0eaa', 0, 94, '2026-02-25 10:16:53', '2026-02-25 10:16:53', 1),
(578, 'uploads/images/2026/02/25/1771982374_763fcbc463fd269def38.jpeg', 'crop_181350_7609.jpeg', 'jpeg', 'image/jpeg', 27954, 172, 172, 'images', '907b6a1e6f3dd70b18b0cd9d00b970fc', 1, 94, '2026-02-25 10:19:34', '2026-02-25 10:19:38', 1),
(579, 'uploads/images/2026/02/25/1771982521_5f454c8a9cca85296df9.jpeg', 'crop_181837_5908.jpeg', 'jpeg', 'image/jpeg', 44328, 172, 172, 'images', 'ec9aed20eda2291d286a11422bbc7408', 1, 94, '2026-02-25 10:22:01', '2026-02-25 10:22:03', 1),
(580, 'uploads/images/2026/02/25/1771982876_66a802a6668318bb48d1.png', 'crop_171039_3183.png', 'png', 'image/png', 11349, 172, 172, 'images', 'a4f029e7fe265239a6c13e01999ec928', 0, 94, '2026-02-25 10:27:56', '2026-02-25 10:27:56', 1),
(581, 'uploads/images/2026/02/25/1771982898_6eb20f8b08d1676c7cf7.png', 'crop_171039_3183.png', 'png', 'image/png', 11349, 172, 172, 'images', '1d469c4edb1d644c9c03c7be8f9c3cb1', 0, 94, '2026-02-25 10:28:18', '2026-02-25 10:28:18', 1),
(582, 'uploads/images/2026/02/25/1771982915_54bc6976d49ef9f7afec.png', 'crop_171039_3183.png', 'png', 'image/png', 11349, 172, 172, 'images', 'b0c33f5b7147fd86cf57cc11e13553a5', 1, 94, '2026-02-25 10:28:35', '2026-02-25 10:28:37', 1),
(583, 'uploads/images/2026/02/25/1771983150_9bf331be3d36e71e1356.png', 'crop_172100_8319.png', 'png', 'image/png', 9684, 172, 172, 'images', 'ba96796e476d320229d6ac2e7054a196', 1, 94, '2026-02-25 10:32:30', '2026-02-25 10:32:49', 1),
(584, 'uploads/images/2026/02/25/1771983212_e16076184bed7b79a408.jpeg', 'crop_181553_5633.jpeg', 'jpeg', 'image/jpeg', 19493, 172, 172, 'images', '70051e8bd3776c030dcf36ba7c7e4757', 1, 94, '2026-02-25 10:33:32', '2026-02-25 10:33:47', 1),
(585, 'uploads/images/2026/02/25/1771983268_5ac9bb96764bbb15fdcb.jpeg', 'crop_181511_5080.jpeg', 'jpeg', 'image/jpeg', 35125, 172, 172, 'images', 'baaecfdcb61261d6c9dff2c08b89feab', 1, 94, '2026-02-25 10:34:28', '2026-02-25 10:34:43', 1),
(586, 'uploads/images/2026/02/25/1771991439_bbe20c283e6171dc66fe.png', 'crop_143244_5806.png', 'png', 'image/png', 461539, 680, 380, 'images', '972a70dddeeb5579cfd9eefbfdec374f', 0, 94, '2026-02-25 12:50:39', '2026-02-25 12:50:39', 1),
(587, 'uploads/images/2026/02/25/1772000177_3326255dda091c0a74a7.png', 'crop_143244_5806.png', 'png', 'image/png', 461539, 680, 380, 'images', 'd3668c20360824f3f6f3ae967a99eec4', 1, 94, '2026-02-25 15:16:17', '2026-02-25 15:18:21', 1),
(588, 'uploads/images/2026/02/25/1772000773_6c0a995eef1063b6e21a.png', 'crop_143335_7752.png', 'png', 'image/png', 350055, 680, 380, 'images', '516615724c172e1ff254cabbdc00181e', 1, 94, '2026-02-25 15:26:13', '2026-02-25 15:26:21', 1),
(589, 'uploads/images/2026/02/25/1772000934_851e6213bac891fb7052.png', 'crop_143417_1754.png', 'png', 'image/png', 317312, 680, 380, 'images', '3c2e3c1aa8409aa926a532c82d677191', 1, 94, '2026-02-25 15:28:54', '2026-02-25 15:29:36', 1),
(590, 'uploads/images/2026/02/25/1772001081_cd7aed97ce561c71c019.png', 'crop_143500_7402.png', 'png', 'image/png', 364481, 680, 380, 'images', '9a425c132c49f1e558823b4f822d4a2e', 1, 94, '2026-02-25 15:31:21', '2026-02-25 15:31:46', 1),
(591, 'uploads/images/2026/02/25/1772001755_1917ba6724413c6398c4.png', 'crop_182521_9973.png', 'png', 'image/png', 294851, 680, 380, 'images', 'f5225f2e968b4f78dbed12356173b4b8', 1, 94, '2026-02-25 15:42:35', '2026-02-25 15:42:54', 1),
(592, 'uploads/images/2026/02/25/1772001890_096ec7d852a3ba3395c1.png', 'crop_182601_5330.png', 'png', 'image/png', 491767, 680, 380, 'images', 'c1e2be70419be022dd46291ee1be62b9', 1, 94, '2026-02-25 15:44:50', '2026-02-25 15:45:07', 1),
(593, 'uploads/images/2026/02/25/1772002136_804cc5722b8d4831fe8a.png', 'crop_182657_9041.png', 'png', 'image/png', 356392, 680, 380, 'images', 'b8a992ef3a05193376eab83838ff2bad', 1, 94, '2026-02-25 15:48:56', '2026-02-25 15:49:26', 1),
(594, 'uploads/images/2026/02/25/1772002802_ea3eb28f5c81ae0cb011.png', 'crop_182756_6603.png', 'png', 'image/png', 449136, 680, 380, 'images', '19f53e0b5f0e4d19887e82a3bcd260ed', 1, 94, '2026-02-25 16:00:02', '2026-02-25 16:00:11', 1),
(595, 'uploads/images/2026/02/25/1772002926_4e02b63fad6aae7c3996.png', 'crop_182837_2278.png', 'png', 'image/png', 391955, 680, 380, 'images', '3a64f67de976cfb99a188c7d96a1680b', 1, 94, '2026-02-25 16:02:06', '2026-02-25 16:02:13', 1),
(596, 'uploads/images/2026/02/25/1772003000_3928cef3cac6f8f915cd.png', 'crop_182920_7237.png', 'png', 'image/png', 447935, 680, 380, 'images', '424cde489dcb711f9add44d63334dfb4', 1, 94, '2026-02-25 16:03:20', '2026-02-25 16:03:33', 1),
(597, 'uploads/images/2026/03/02/1772422504_e20cc86bdbbba5da036b.png', 'crop_172322_2547.png', 'png', 'image/png', 2502951, 1920, 920, 'images', '5dc0292679df00a3f0a8437a91c8304f', 0, 94, '2026-03-02 12:35:04', '2026-03-02 12:38:05', 1),
(598, 'uploads/images/2026/03/02/1772422607_a182042ebe03e36e03c4.png', 'crop_172500_9535.png', 'png', 'image/png', 289917, 1920, 920, 'images', '8eda89b4c456448872f216876678a25e', 0, 94, '2026-03-02 12:36:47', '2026-03-02 14:15:26', 1),
(599, 'uploads/images/2026/03/02/1772422622_6321a03691a752e794f4.png', 'crop_172554_5864.png', 'png', 'image/png', 1698240, 1920, 920, 'images', '8eda89b4c456448872f216876678a25e', 0, 94, '2026-03-02 12:37:02', '2026-03-02 14:15:26', 1),
(600, 'uploads/images/2026/03/02/1772422639_8d26bc3bfdfad332b82b.png', 'crop_172838_3776.png', 'png', 'image/png', 1076121, 1920, 920, 'images', '8eda89b4c456448872f216876678a25e', 0, 94, '2026-03-02 12:37:19', '2026-03-02 14:15:26', 1),
(601, 'uploads/images/2026/03/02/1772423589_2a6d2f61051adbd202d9.png', 'crop_181740_8331.png', 'png', 'image/png', 712386, 750, 650, 'images', '1c449788f558dc148c49b8b870c4594c', 1, 94, '2026-03-02 12:53:09', '2026-03-02 12:54:30', 1),
(602, 'uploads/images/2026/03/02/1772423618_7c21e7a7b73465ebe4e8.png', 'crop_181717_5243.png', 'png', 'image/png', 133986, 750, 650, 'images', '1c449788f558dc148c49b8b870c4594c', 1, 94, '2026-03-02 12:53:38', '2026-03-02 12:54:30', 1),
(603, 'uploads/images/2026/03/02/1772423637_8c2742c0b4eff9753900.png', 'crop_181658_6443.png', 'png', 'image/png', 593041, 750, 650, 'images', '1c449788f558dc148c49b8b870c4594c', 1, 94, '2026-03-02 12:53:57', '2026-03-02 12:54:30', 1),
(604, 'uploads/images/2026/03/02/1772423654_3dbc89fa0165ed634ab9.png', 'crop_181627_8037.png', 'png', 'image/png', 437715, 750, 650, 'images', '1c449788f558dc148c49b8b870c4594c', 1, 94, '2026-03-02 12:54:14', '2026-03-02 12:54:30', 1),
(605, 'uploads/images/2026/03/02/1772428372_25612ff855aaf9b04f7f.png', 'crop_172322_2547.png', 'png', 'image/png', 2502951, 1920, 920, 'images', '2787ef42ec26f56973889ac49b7b5839', 1, 94, '2026-03-02 14:12:52', '2026-03-02 14:15:26', 1),
(606, 'uploads/images/2026/03/02/1772428403_8f38de8ee2e88c36c47b.png', 'crop_172500_9535.png', 'png', 'image/png', 289917, 1920, 920, 'images', '2787ef42ec26f56973889ac49b7b5839', 1, 94, '2026-03-02 14:13:23', '2026-03-02 14:15:26', 1),
(607, 'uploads/images/2026/03/02/1772428454_1e39790be8aa5f413182.png', 'crop_172554_5864.png', 'png', 'image/png', 1698240, 1920, 920, 'images', '2787ef42ec26f56973889ac49b7b5839', 1, 94, '2026-03-02 14:14:14', '2026-03-02 14:15:26', 1),
(608, 'uploads/images/2026/03/02/1772428477_f5fd2fd4c206ca5947e7.png', 'crop_172838_3776.png', 'png', 'image/png', 1076121, 1920, 920, 'images', '2787ef42ec26f56973889ac49b7b5839', 1, 94, '2026-03-02 14:14:37', '2026-03-02 14:15:26', 1);

-- --------------------------------------------------------

--
-- 表的结构 `media_download_tokens`
--

CREATE TABLE `media_download_tokens` (
  `id` int(11) NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  `max_uses` int(3) DEFAULT NULL,
  `used_times` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `media_relations`
--

CREATE TABLE `media_relations` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '主键',
  `media_id` int(11) UNSIGNED NOT NULL COMMENT '文件ID',
  `owner_type` varchar(50) NOT NULL COMMENT '所属业务类型，如 article / product / category',
  `owner_id` bigint(20) UNSIGNED NOT NULL COMMENT '所属业务ID',
  `usage_type` varchar(50) NOT NULL COMMENT '用途，如 thumbnail / content / gallery',
  `sort` int(10) UNSIGNED DEFAULT '0' COMMENT '排序，越小越靠前',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='通用图片中间表（多业务、多用途图片关系）' ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `media_relations`
--

INSERT INTO `media_relations` (`id`, `media_id`, `owner_type`, `owner_id`, `usage_type`, `sort`, `created_at`, `updated_at`) VALUES
(573, 562, 'slide', 11, 'gallery', 0, '2026-02-03 17:28:26', '2026-02-03 17:28:26'),
(574, 563, 'slide', 11, 'gallery', 1, '2026-02-03 17:28:26', '2026-02-03 17:28:26'),
(575, 564, 'slide', 11, 'gallery', 2, '2026-02-03 17:28:26', '2026-02-03 17:28:26'),
(576, 565, 'slide', 12, 'gallery', 0, '2026-02-03 17:29:37', '2026-02-03 17:29:37'),
(577, 566, 'slide', 12, 'gallery', 1, '2026-02-03 17:29:37', '2026-02-03 17:29:37'),
(578, 567, 'slide', 12, 'gallery', 2, '2026-02-03 17:29:37', '2026-02-03 17:29:37'),
(588, 557, 'article', 384, 'thumbnail', 0, '2026-02-03 18:29:24', '2026-02-03 18:29:24'),
(589, 556, 'article', 385, 'thumbnail', 0, '2026-02-03 18:30:13', '2026-02-03 18:30:13'),
(591, 558, 'article', 386, 'thumbnail', 0, '2026-02-04 11:09:00', '2026-02-04 11:09:00'),
(592, 553, 'article', 383, 'thumbnail', 0, '2026-02-04 11:09:40', '2026-02-04 11:09:40'),
(593, 552, 'article', 382, 'thumbnail', 0, '2026-02-04 11:09:51', '2026-02-04 11:09:51'),
(594, 550, 'article', 381, 'thumbnail', 0, '2026-02-04 11:10:01', '2026-02-04 11:10:01'),
(596, 578, 'article', 388, 'thumbnail', 0, '2026-02-25 10:20:10', '2026-02-25 10:20:10'),
(597, 579, 'article', 389, 'thumbnail', 0, '2026-02-25 10:22:03', '2026-02-25 10:22:03'),
(598, 582, 'article', 390, 'thumbnail', 0, '2026-02-25 10:28:37', '2026-02-25 10:28:37'),
(599, 583, 'article', 391, 'thumbnail', 0, '2026-02-25 10:32:49', '2026-02-25 10:32:49'),
(600, 584, 'article', 392, 'thumbnail', 0, '2026-02-25 10:33:47', '2026-02-25 10:33:47'),
(601, 585, 'article', 393, 'thumbnail', 0, '2026-02-25 10:34:43', '2026-02-25 10:34:43'),
(602, 587, 'article', 403, 'thumbnail', 0, '2026-02-25 15:18:21', '2026-02-25 15:18:21'),
(603, 588, 'article', 404, 'thumbnail', 0, '2026-02-25 15:26:21', '2026-02-25 15:26:21'),
(604, 589, 'article', 405, 'thumbnail', 0, '2026-02-25 15:29:36', '2026-02-25 15:29:36'),
(605, 590, 'article', 406, 'thumbnail', 0, '2026-02-25 15:31:46', '2026-02-25 15:31:46'),
(606, 591, 'article', 407, 'thumbnail', 0, '2026-02-25 15:42:54', '2026-02-25 15:42:54'),
(607, 592, 'article', 408, 'thumbnail', 0, '2026-02-25 15:45:07', '2026-02-25 15:45:07'),
(608, 593, 'article', 409, 'thumbnail', 0, '2026-02-25 15:49:26', '2026-02-25 15:49:26'),
(609, 594, 'article', 410, 'thumbnail', 0, '2026-02-25 16:00:11', '2026-02-25 16:00:11'),
(610, 595, 'article', 411, 'thumbnail', 0, '2026-02-25 16:02:13', '2026-02-25 16:02:13'),
(612, 596, 'article', 412, 'thumbnail', 0, '2026-02-26 16:29:44', '2026-02-26 16:29:44'),
(618, 601, 'slide', 13, 'gallery', 0, '2026-03-02 12:54:30', '2026-03-02 12:54:30'),
(619, 602, 'slide', 13, 'gallery', 1, '2026-03-02 12:54:30', '2026-03-02 12:54:30'),
(620, 603, 'slide', 13, 'gallery', 2, '2026-03-02 12:54:30', '2026-03-02 12:54:30'),
(621, 604, 'slide', 13, 'gallery', 3, '2026-03-02 12:54:30', '2026-03-02 12:54:30'),
(622, 605, 'slide', 10, 'gallery', 0, '2026-03-02 14:15:26', '2026-03-02 14:15:26'),
(623, 606, 'slide', 10, 'gallery', 1, '2026-03-02 14:15:26', '2026-03-02 14:15:26'),
(624, 607, 'slide', 10, 'gallery', 2, '2026-03-02 14:15:26', '2026-03-02 14:15:26'),
(625, 608, 'slide', 10, 'gallery', 3, '2026-03-02 14:15:26', '2026-03-02 14:15:26');

-- --------------------------------------------------------

--
-- 表的结构 `membership_levels`
--

CREATE TABLE `membership_levels` (
  `level_id` int(10) UNSIGNED NOT NULL COMMENT '等级ID，主键',
  `level_name` varchar(50) NOT NULL COMMENT '等级名称 (如: 普通会员, 黄金会员)',
  `min_points` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '晋升所需最低积分/经验值',
  `max_points` int(10) UNSIGNED DEFAULT NULL COMMENT '保持等级所需的最高积分/经验值 (NULL表示无限)',
  `discount_rate` decimal(5,2) DEFAULT NULL COMMENT '该等级享有的折扣率 (如: 0.90 表示9折)',
  `description` text COMMENT '等级描述和特权说明',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='会员等级定义表' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `members_points_log`
--

CREATE TABLE `members_points_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT '用户ID',
  `change_points` int(11) NOT NULL COMMENT '变动积分，正数=增加，负数=减少',
  `before_points` int(11) NOT NULL COMMENT '变动前积分',
  `after_points` int(11) NOT NULL COMMENT '变动后积分',
  `type` varchar(30) NOT NULL COMMENT '积分类型，如: sign, order, refund, admin_add, admin_reduce',
  `description` varchar(255) DEFAULT NULL COMMENT '描述，如: 完成订单获得积分',
  `related_id` int(11) DEFAULT NULL COMMENT '关联ID，如订单ID',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `menu`
--

CREATE TABLE `menu` (
  `id` int(11) UNSIGNED NOT NULL,
  `parent_id` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `title` varchar(255) DEFAULT NULL,
  `icon` varchar(55) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `permission` varchar(100) DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `active`, `title`, `icon`, `route`, `permission`, `sequence`, `created_at`, `updated_at`) VALUES
(1, 0, 1, '대시보드', 'fas fa-tachometer-alt', 'haoadmin', 'menu.show.dashboard', 2, '2025-12-16 09:47:41', '2026-02-27 10:41:17'),
(2, 0, 1, '시스템', 'fas fa-cog', '#', 'menu.show.system', 32, '2025-12-16 09:47:41', '2026-02-27 10:41:17'),
(4, 2, 1, '사용자', 'fas fa-users', 'haoadmin/user/manage', 'menu.show.user', 33, '2025-12-16 09:47:41', '2026-02-27 10:41:17'),
(7, 2, 1, '관리자 메뉴', 'fas fa-th-list', 'haoadmin/menu/manage', 'menu.show.menu', 35, '2025-12-16 09:47:41', '2026-02-27 10:41:17'),
(15, 0, 1, '접속자집계', 'fab fa-get-pocket', 'haoadmin/authlogs', 'menu.show.safety', 44, '2025-12-18 09:27:46', '2026-02-27 10:41:17'),
(16, 0, 1, '홈 바로가기', 'fas fa-desktop', '/', NULL, 46, '2025-12-19 02:32:19', '2026-02-27 10:41:17'),
(18, 0, 1, '분류', 'fas fa-list', 'haoadmin/category/manage', 'menu.show.category', 26, '2025-12-19 03:27:21', '2026-02-27 10:41:17'),
(23, 0, 1, '문의', 'fas fa-comment-alt', 'haoadmin/form/list/contact_us', 'menu.show.contact', 22, '2025-12-30 06:56:32', '2026-02-27 10:41:17'),
(25, 0, 1, '팝업창', 'fas fa-audio-description', 'haoadmin/popup/manage', '', 30, '2025-12-30 07:37:07', '2026-02-27 10:41:17'),
(31, 0, 1, '네이비게이션', 'fas fa-map-signs', 'haoadmin/navigation/manage', 'menu.show.category', 24, '2026-01-04 07:57:54', '2026-02-27 10:41:17'),
(32, 2, 1, '환경설정', 'fas fa-toggle-on', 'haoadmin/config/edit', NULL, 41, '2026-01-05 02:00:32', '2026-02-27 10:41:17'),
(33, 2, 1, '폼 관리', 'fas fa-grip-horizontal', 'haoadmin/form/manage', 'menu.show.contact', 37, '2026-01-09 11:44:33', '2026-02-27 10:41:17'),
(35, 2, 1, 'SEO 설정', 'fab fa-internet-explorer', 'haoadmin/seo/edit', 'menu.show.system', 39, '2026-01-21 12:42:05', '2026-02-27 10:41:17'),
(37, 0, 1, '슬라이드', 'far fa-object-ungroup', 'haoadmin/slide/manage', 'menu.show.system', 28, '2026-01-22 16:40:49', '2026-02-27 10:41:17'),
(38, 22, 1, 'OEM제품  목록', 'fas fa-align-justify', 'haoadmin/article/manage/91/list', 'menu.show.article', 11, '2026-01-27 12:56:21', '2026-02-03 10:22:38'),
(39, 22, 1, '휴지통', 'fas fa-trash-alt', 'haoadmin/article/recycle/91/list', 'menu.show.article', 13, '2026-01-27 13:02:08', '2026-02-03 10:22:45'),
(42, 41, 1, '공지사항 목록', 'fas fa-align-justify', 'haoadmin/article/manage/89/list', 'menu.show.article', 5, '2026-01-30 12:01:23', '2026-02-25 10:11:48'),
(43, 41, 1, '휴지통', 'fas fa-trash-alt', 'haoadmin/article/recycle', NULL, 7, '2026-01-30 12:02:00', '2026-02-25 10:11:48'),
(45, 44, 1, '자사제품 목록', 'fas fa-align-justify', 'haoadmin/article/manage/93/list', 'menu.show.article', 17, '2026-01-30 12:17:48', '2026-02-03 10:22:32'),
(46, 44, 1, '휴지통', 'fas fa-trash-alt', 'haoadmin/article/recycle/93/list', 'menu.show.article', 19, '2026-01-30 12:18:52', '2026-02-03 10:22:51'),
(48, 0, 1, '민원노트', 'fab fa-wpforms', '#', 'menu.show.article', 4, '2026-02-25 10:06:43', '2026-02-27 10:41:17'),
(49, 48, 1, '민원노트', 'fas fa-align-justify', 'haoadmin/article/manage/95/list', 'menu.show.article', 5, '2026-02-25 10:08:01', '2026-02-27 10:41:17'),
(50, 48, 1, '휴지통', 'fas fa-trash-alt', 'haoadmin/article/recycle', NULL, 7, '2026-02-25 10:11:31', '2026-02-27 10:41:17'),
(51, 0, 1, 'FAQ', 'fab fa-wpforms', '#', 'menu.show.article', 10, '2026-02-25 11:55:53', '2026-02-27 10:41:17'),
(52, 51, 1, 'FAQ', 'fas fa-align-justify', 'haoadmin/article/manage/89/list', 'menu.show.article', 11, '2026-02-25 12:01:13', '2026-02-27 10:41:17'),
(53, 51, 1, '휴지통', 'fas fa-trash-alt', 'haoadmin/article/recycle', NULL, 13, '2026-02-25 12:02:23', '2026-02-27 10:41:17'),
(55, 54, 1, 'Story1', 'fas fa-align-justify', 'haoadmin/article/manage/99/list', 'menu.show.article', 17, '2026-02-25 12:29:08', '2026-02-25 12:39:44'),
(56, 54, 1, '휴지통', 'fas fa-trash-alt', 'haoadmin/article/recycle', NULL, 19, '2026-02-25 12:30:09', '2026-02-25 12:39:44'),
(58, 57, 1, 'Story2', 'fas fa-align-justify', 'haoadmin/article/manage/100/list', 'menu.show.article', 23, '2026-02-25 12:31:43', '2026-02-25 12:39:44'),
(59, 57, 1, '휴지통', 'fas fa-trash-alt', 'haoadmin/article/recycle', NULL, 25, '2026-02-25 12:32:22', '2026-02-25 12:39:44'),
(61, 60, 1, 'Story3', 'fas fa-align-justify', 'haoadmin/article/manage/101/list', 'menu.show.article', 55, '2026-02-25 12:42:16', '2026-02-25 12:42:16'),
(62, 60, 1, '휴지통', 'fas fa-trash-alt', 'haoadmin/article/recycle', NULL, 56, '2026-02-25 12:42:46', '2026-02-25 12:42:46'),
(64, 63, 1, 'story4', 'fas fa-align-justify', 'haoadmin/article/manage/105/list', 'menu.show.article', 58, '2026-02-26 15:43:53', '2026-02-26 15:43:53'),
(65, 0, 1, '스토리', 'fab fa-wpforms', '#', 'menu.show.article', 16, '2026-02-26 16:17:35', '2026-02-27 10:41:17'),
(66, 65, 1, '스토리', 'fas fa-align-justify', 'haoadmin/article/manage/98/list', 'menu.show.article', 17, '2026-02-26 16:18:48', '2026-02-27 10:41:17'),
(67, 65, 1, '휴지통', 'fas fa-trash-alt', 'haoadmin/article/recycle', NULL, 19, '2026-02-27 10:39:54', '2026-02-27 10:41:17');

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `navigation`
--

CREATE TABLE `navigation` (
  `id` int(11) UNSIGNED NOT NULL,
  `parent_id` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `title` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `open_new` tinyint(1) DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `navigation`
--

INSERT INTO `navigation` (`id`, `parent_id`, `active`, `title`, `subject`, `description`, `url`, `open_new`, `sequence`, `created_at`, `updated_at`) VALUES
(78, 0, 1, '회사소개', 'company', '', '/pages/company', 0, 28, '2026-02-25 10:53:44', '2026-02-25 10:53:44'),
(79, 0, 1, '베트남 회사 설립', 'vn company', '', '/pages/vn_company', 0, 29, '2026-02-25 10:56:44', '2026-02-25 10:56:44'),
(80, 0, 1, '베트남위생허가', 'Vietnam Sanitary Permit', '', '/pages/cosmetics', 0, 30, '2026-02-25 11:06:52', '2026-02-25 11:06:52'),
(81, 80, 1, '화장품', 'cosmetics', '', '/pages/cosmetics', 0, 31, '2026-02-25 11:07:50', '2026-02-25 11:07:50'),
(82, 80, 1, '건강기능식품', 'Health Food', '', '/pages/health_food', 0, 32, '2026-02-25 11:08:35', '2026-02-25 11:09:24'),
(83, 80, 1, '일반식품', 'General Food', '', '/pages/general_food', 0, 33, '2026-02-25 11:09:14', '2026-02-25 11:09:14'),
(84, 0, 1, '베트남 상표등록 대리', 'Vietnam Trademark', '', '/pages/vn_trademark', 0, 34, '2026-02-25 11:16:20', '2026-02-25 11:16:20'),
(85, 0, 1, '베트남 통번역', 'Vietnamese Translation', '', '/pages/vn_translation1', 0, 35, '2026-02-25 11:22:15', '2026-02-25 11:22:53'),
(86, 85, 1, '번역', 'translation', '', '/pages/vn_translation1', 0, 36, '2026-02-25 11:22:45', '2026-02-25 11:22:45'),
(87, 85, 1, '통역', 'translation', '', '/pages/vn_translation2', 0, 37, '2026-02-25 11:23:21', '2026-02-25 11:23:21'),
(88, 0, 1, '베트남 공증 및 영사인증', 'Vietnam Certification and Consulate', '', 'http://newpartner.haoweb.co.kr/ko/sub/109/sub2', 1, 38, '2026-02-25 11:28:43', '2026-04-09 17:54:13'),
(89, 0, 1, '스토리', 'Story', '', 'article/98/story', 0, 39, '2026-02-25 11:32:10', '2026-02-25 11:32:10');

-- --------------------------------------------------------

--
-- 表的结构 `popups`
--

CREATE TABLE `popups` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text,
  `show_once` tinyint(1) DEFAULT '1' COMMENT '1=只显示一次，0=每次都显示',
  `location` varchar(255) DEFAULT NULL,
  `start_at` varchar(255) DEFAULT NULL,
  `end_at` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `offset_left` varchar(255) DEFAULT NULL,
  `offset_top` varchar(255) DEFAULT NULL,
  `width` int(4) DEFAULT NULL,
  `height` int(4) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lang` varchar(255) DEFAULT NULL,
  `open_new` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `class` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `context` varchar(255) DEFAULT NULL,
  `type` varchar(31) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `sites`
--

CREATE TABLE `sites` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `site_domains`
--

CREATE TABLE `site_domains` (
  `id` int(11) NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `is_primary` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `lang` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `autoplay` tinyint(1) DEFAULT NULL,
  `delay` int(11) DEFAULT NULL,
  `speed` int(11) DEFAULT NULL,
  `loop` tinyint(1) DEFAULT NULL,
  `pagination` tinyint(1) DEFAULT NULL,
  `navigation` tinyint(1) DEFAULT NULL,
  `scrollbar` tinyint(1) DEFAULT NULL,
  `views` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `slide`
--

INSERT INTO `slide` (`id`, `lang`, `code`, `active`, `created_at`, `created_by`, `updated_at`, `autoplay`, `delay`, `speed`, `loop`, `pagination`, `navigation`, `scrollbar`, `views`) VALUES
(10, 'ko', 'PC_Main_Banner', 1, '2026-01-28 14:09:48', NULL, '2026-03-02 14:15:26', 1, 3000, 500, 1, 1, 1, 1, NULL),
(13, 'ko', 'Mobile_Main_Banner', 1, '2026-03-02 12:39:21', NULL, '2026-03-02 12:54:30', 1, 3000, 500, 1, 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `slide_items`
--

CREATE TABLE `slide_items` (
  `id` int(11) NOT NULL,
  `slide_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `open_new` tinyint(1) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `slide_items`
--

INSERT INTO `slide_items` (`id`, `slide_id`, `title`, `subject`, `description`, `content`, `image`, `url`, `open_new`, `video`) VALUES
(63, 13, 'VN Slide One(M)', '', '', '', 'uploads/images/2026/03/02/1772423589_2a6d2f61051adbd202d9.png', '', 1, ''),
(64, 13, 'VN Slide Two(M)', '', '', '', 'uploads/images/2026/03/02/1772423618_7c21e7a7b73465ebe4e8.png', '', 1, ''),
(65, 13, 'VN Slide Three(M)', '', '', '', 'uploads/images/2026/03/02/1772423637_8c2742c0b4eff9753900.png', '', 1, ''),
(66, 13, 'VN Slide Four(M)', '', '', '', 'uploads/images/2026/03/02/1772423654_3dbc89fa0165ed634ab9.png', '', 1, ''),
(67, 10, 'VN Slide One', '', '', '', 'uploads/images/2026/03/02/1772428372_25612ff855aaf9b04f7f.png', '', 1, ''),
(68, 10, 'VN Slide Two', '', '', '', 'uploads/images/2026/03/02/1772428403_8f38de8ee2e88c36c47b.png', '', 1, ''),
(69, 10, 'VN Slide Three', '', '', '', 'uploads/images/2026/03/02/1772428454_1e39790be8aa5f413182.png', '', 1, ''),
(70, 10, 'VN Slide Four', '', '', '', 'uploads/images/2026/03/02/1772428477_f5fd2fd4c206ca5947e7.png', '', 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `member_code` varchar(12) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `kakao_id` varchar(255) DEFAULT NULL,
  `naver_id` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `nickname` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`, `code`, `member_code`, `avatar`, `kakao_id`, `naver_id`, `phone`, `nickname`) VALUES
(94, 'haocms', NULL, NULL, 1, NULL, '2026-02-02 11:53:16', '2026-02-02 11:53:17', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL),
(101, 'felix', NULL, NULL, 1, NULL, '2026-03-17 12:39:46', '2026-03-17 16:29:24', NULL, NULL, '', 'http://img1.kakaocdn.net/thumb/R640x640.q70/?fname=http://t1.kakaocdn.net/account_images/default_profile.jpeg', '4487215695', NULL, '+86 186 4280 1691', NULL),
(106, NULL, NULL, NULL, 1, NULL, '2026-04-09 10:36:35', '2026-04-09 10:36:35', NULL, NULL, '', NULL, NULL, NULL, '01022223333', 'Tester'),
(107, 'redtrans', NULL, NULL, 1, NULL, '2026-04-24 18:52:04', '2026-04-24 18:52:04', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL),
(108, '2132', NULL, NULL, 1, NULL, '2026-04-27 11:49:28', '2026-04-27 11:49:28', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `verification_codes`
--

CREATE TABLE `verification_codes` (
  `_id` char(24) NOT NULL COMMENT 'ID，系统自动生成',
  `code` varchar(255) DEFAULT NULL COMMENT '验证码',
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `device_uuid` varchar(255) DEFAULT NULL COMMENT '设备UUID，常用于图片验证码',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `expired_date` timestamp NULL DEFAULT NULL COMMENT '过期时间',
  `ip` varchar(50) DEFAULT NULL COMMENT '请求时客户端IP地址',
  `mobile` varchar(20) DEFAULT NULL COMMENT '手机号码',
  `scene` varchar(50) DEFAULT NULL COMMENT '使用验证码的场景，如：login, bind, unbind, pay',
  `state` tinyint(1) DEFAULT '0' COMMENT '验证状态：0 未验证、1 已验证、2 已作废'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='验证码表' ROW_FORMAT=DYNAMIC;

--
-- 转储表的索引
--

--
-- 表的索引 `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_posts_author_id` (`created_by`) USING BTREE,
  ADD KEY `idx_posts_category_id` (`category_id`) USING BTREE;

--
-- 表的索引 `articles_lang`
--
ALTER TABLE `articles_lang`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `lang` (`article_id`,`lang`(191)) USING BTREE;

--
-- 表的索引 `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`) USING BTREE;

--
-- 表的索引 `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `type_secret` (`type`,`secret`) USING BTREE,
  ADD KEY `secret` (`secret`) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- 表的索引 `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_type_identifier` (`id_type`(191),`identifier`(191)) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- 表的索引 `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `auth_permissions_users_user_id_foreign` (`user_id`) USING BTREE;

--
-- 表的索引 `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `selector` (`selector`) USING BTREE,
  ADD KEY `auth_remember_tokens_user_id_foreign` (`user_id`) USING BTREE;

--
-- 表的索引 `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_type_identifier` (`id_type`(191),`identifier`(191)) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- 表的索引 `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `email_queue`
--
ALTER TABLE `email_queue`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_status` (`status`) USING BTREE;

--
-- 表的索引 `family_sites`
--
ALTER TABLE `family_sites`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `code version` (`code`,`version`) USING BTREE,
  ADD KEY `code` (`code`) USING BTREE;

--
-- 表的索引 `form_fields`
--
ALTER TABLE `form_fields`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `code` (`form_code`,`version`) USING BTREE;

--
-- 表的索引 `form_submit`
--
ALTER TABLE `form_submit`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `media_download_tokens`
--
ALTER TABLE `media_download_tokens`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `media_relations`
--
ALTER TABLE `media_relations`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `uk_image_owner_usage` (`media_id`,`owner_type`,`owner_id`,`usage_type`) USING BTREE,
  ADD KEY `idx_owner` (`owner_type`,`owner_id`) USING BTREE,
  ADD KEY `idx_image` (`media_id`) USING BTREE,
  ADD KEY `idx_usage` (`usage_type`) USING BTREE;

--
-- 表的索引 `membership_levels`
--
ALTER TABLE `membership_levels`
  ADD PRIMARY KEY (`level_id`) USING BTREE,
  ADD UNIQUE KEY `level_name` (`level_name`) USING BTREE;

--
-- 表的索引 `members_points_log`
--
ALTER TABLE `members_points_log`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_user` (`user_id`) USING BTREE,
  ADD KEY `idx_type` (`type`) USING BTREE;

--
-- 表的索引 `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `popups`
--
ALTER TABLE `popups`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `class_key` (`class`(191),`key`(191)) USING BTREE;

--
-- 表的索引 `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `site_domains`
--
ALTER TABLE `site_domains`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `domain` (`domain`(191)) USING BTREE;

--
-- 表的索引 `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `langcode` (`lang`(191),`code`(191)) USING BTREE;

--
-- 表的索引 `slide_items`
--
ALTER TABLE `slide_items`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`) USING BTREE,
  ADD UNIQUE KEY `phone` (`phone`);

--
-- 表的索引 `verification_codes`
--
ALTER TABLE `verification_codes`
  ADD PRIMARY KEY (`_id`) USING BTREE,
  ADD KEY `idx_email` (`email`(191)) USING BTREE,
  ADD KEY `idx_mobile` (`mobile`) USING BTREE,
  ADD KEY `idx_device_uuid` (`device_uuid`(191)) USING BTREE,
  ADD KEY `idx_scene` (`scene`) USING BTREE;

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=439;

--
-- 使用表AUTO_INCREMENT `articles_lang`
--
ALTER TABLE `articles_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=447;

--
-- 使用表AUTO_INCREMENT `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- 使用表AUTO_INCREMENT `auth_identities`
--
ALTER TABLE `auth_identities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- 使用表AUTO_INCREMENT `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- 使用表AUTO_INCREMENT `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- 使用表AUTO_INCREMENT `email_queue`
--
ALTER TABLE `email_queue`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `family_sites`
--
ALTER TABLE `family_sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- 使用表AUTO_INCREMENT `form_fields`
--
ALTER TABLE `form_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=812;

--
-- 使用表AUTO_INCREMENT `form_submit`
--
ALTER TABLE `form_submit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- 使用表AUTO_INCREMENT `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- 使用表AUTO_INCREMENT `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=609;

--
-- 使用表AUTO_INCREMENT `media_download_tokens`
--
ALTER TABLE `media_download_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `media_relations`
--
ALTER TABLE `media_relations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=626;

--
-- 使用表AUTO_INCREMENT `membership_levels`
--
ALTER TABLE `membership_levels`
  MODIFY `level_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '等级ID，主键';

--
-- 使用表AUTO_INCREMENT `members_points_log`
--
ALTER TABLE `members_points_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- 使用表AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `navigation`
--
ALTER TABLE `navigation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- 使用表AUTO_INCREMENT `popups`
--
ALTER TABLE `popups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `site_domains`
--
ALTER TABLE `site_domains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用表AUTO_INCREMENT `slide_items`
--
ALTER TABLE `slide_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- 限制导出的表
--

--
-- 限制表 `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_posts_author` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_posts_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 限制表 `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- 限制表 `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD CONSTRAINT `auth_identities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- 限制表 `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD CONSTRAINT `auth_permissions_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- 限制表 `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD CONSTRAINT `auth_remember_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- 限制表 `form_fields`
--
ALTER TABLE `form_fields`
  ADD CONSTRAINT `code` FOREIGN KEY (`form_code`,`version`) REFERENCES `forms` (`code`, `version`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
