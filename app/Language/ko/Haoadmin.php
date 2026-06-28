<?php

return [
    'global' => [
        'save'   => '저장',
        'close'  => '닫기',
        'action' => '작업',
        'is_read' => '읽음',
        'logout' => '로그아웃',
        'upload' => '업로드',
        'selectfile' => '파일선택',
        'imagecrop' => '이미지 크롭',
        'thumbnail' => '썸네일',
        'use_fields' => '항목',
        'field_type' => '항목 유형',
        'field_config' => '항목 설정',
        'file' => '파일 첨부',
        'category' => '카테고리',
        'selectfile' => '파일선택',
        'required' => '필수',
        'title' => '제목/서류 종류',
        'subject' => '소요 기간/Date',
        'price' => '금액',
        'blog' => '블로그',
        'blog_img'=>'사진',
        'name' => '저자',
        'notice_title' => '주의사항/안내사항(Title)',
        'notice_info' => '주의사항/안내사항(Detail)',
        'description' => '포함 사항',
        'content' => '내용',
        'meta_title' => '메타 타이틀',
        'meta_keywords' => '메타 키워드',
        'meta_description' => '메타 설명',
        'gallery' => '갤러리',
        'is_main'   => '메인표시',
        'is_fixed'  => '상위고정',
        'sequence' => '순위',
        'user_agent' => '사용자환경',
        'author' =>'작성자',
        'created_at' =>'작성일',
        'active'     => '활성',
        'non_active'     => '비활성',
        'language' => '언어',
        'search' => '검색',
        'direct_upload' => '원본 업로드',
        'crop_upload' => '크롭 업로드',
        'open_new' => '새창',
        'placeholder' => [
            'keyword' => '검색어를 입력하세요',
        ],
        'sweet'  => [
            'title'          => '정말로 진행하시겠습니까?',
            'text'           => '이 작업은 되돌릴 수 없습니다!',
            'confirm_delete' => '예, 삭제합니다!',
            'restore'          => '예, 복원합니다!',
        ],
    ],
    'auth' => [
        'msg' =>[
            'dif_site_id' => '이 사용자는 현재 사이트에서 사용할 수 없습니다.'
        ]
    ],



    /**
     * Permission.
     */
    'permission' => [
        'add'      => '권한 추가',
        'edit'     => '권한 수정',
        'title'    => '권한 관리',
        'subtitle' => '권한 목록',
        'fields'   => [
            'name'            => '권한',
            'description'     => '설명',
            'plc_name'        => '권한 이름',
            'plc_description' => '권한 설명',
        ],
        'msg' => [
            'msg_insert'   => '권한이 정상적으로 추가되었습니다.',
            'msg_update'   => '권한 ID {0}이(가) 정상적으로 수정되었습니다.',
            'msg_delete'   => '권한 ID {0}이(가) 정상적으로 삭제되었습니다.',
            'msg_get'      => '권한 ID {0}을(를) 성공적으로 불러왔습니다.',
            'msg_get_fail' => '권한 ID {0}을(를) 찾을 수 없거나 이미 삭제되었습니다.',
        ],
    ],

    /**
     * Role.
     */
    'role' => [
        'add'      => '역할 추가',
        'edit'     => '역할 수정',
        'title'    => '역할 관리',
        'subtitle' => '역할 목록',
        'fields'   => [
            'name'            => '역할',
            'description'     => '설명',
            'plc_name'        => '역할 이름',
            'plc_description' => '역할 설명',
        ],
        'msg' => [
            'msg_insert'   => '역할이 정상적으로 추가되었습니다.',
            'msg_update'   => '역할 ID {0}이(가) 정상적으로 수정되었습니다.',
            'msg_delete'   => '역할 ID {0}이(가) 정상적으로 삭제되었습니다.',
            'msg_get'      => '역할 ID {0}을(를) 성공적으로 불러왔습니다.',
            'msg_get_fail' => '역할 ID {0}을(를) 찾을 수 없거나 이미 삭제되었습니다.',
        ],
    ],

    /**
     * Menu.
     */
    'menu' => [
        'expand'   => '펼치기',
        'collapse' => '접기',
        'refresh'  => '새로고침',
        'add'      => '메뉴 추가',
        'edit'     => '메뉴 수정',
        'title'    => '메뉴 관리',
        'subtitle' => '메뉴 목록',
        'move' => '분류이동저장',
        'fields'   => [
            'parent'         => '상위 메뉴',
            'warning_parent' => '주의! 메뉴는 최대 2단계 깊이까지만 지원됩니다.',
            'active'         => '활성',
            'non_active'     => '비활성',
            'icon'           => '아이콘',
            'info_icon'      => '더 많은 아이콘은 다음을 참고하세요',
            'place_icon'     => 'Font Awesome 아이콘.',
            'name'           => '제목',
            'place_title'    => '메뉴 이름',
            'route'          => '라우트',
            'place_route'    => '메뉴 링크용 라우트',
        ],
        'msg' => [
            'msg_insert'     => '메뉴가 정상적으로 추가되었습니다.',
            'msg_update'     => '메뉴가 정상적으로 수정되었습니다.',
            'msg_delete'     => '메뉴가 정상적으로 삭제되었습니다.',
            'msg_get'        => '메뉴를 성공적으로 불러왔습니다.',
            'msg_get_fail'   => '메뉴를 찾을 수 없거나 이미 삭제되었습니다.',
            'msg_fail_order' => '메뉴 순서 변경에 실패했습니다.',
        ],
    ],

    /**
     * category.
     */
    'category' => [
        'add'      => '분류 추가',
        'edit'     => '분류 수정',
        'title'    => '분류 관리',
        'subtitle' => '분류 설정',
        'fields'   => [
            'parent'         => '상위 분류',
            'active'         => '활성',
            'non_active'     => '비활성',
            'icon'           => '아이콘',
            'subject'        => '주제',
            'name'           => '분류명',
            'url'            => '링크',
            'is_hot'         => '인기표시',
            'is_main'        => '메인표시',
            'code'           => '코드',
            'description'    => '설명',
        ],
        'msg' => [
            'msg_insert'     => '분류가 정상적으로 추가되었습니다.',
            'msg_update'     => '분류가 정상적으로 수정되었습니다.',
            'msg_delete'     => '분류가 정상적으로 삭제되었습니다.',
            'msg_get'        => '분류를 성공적으로 불러왔습니다.',
            'msg_get_fail'   => '분류를 찾을 수 없거나 이미 삭제되었습니다.',
            'msg_fail_order' => '분류 순서 변경에 실패했습니다.',
        ],
    ],

    /**
     * navigation.
     */
    'navigation' => [
        'add'      => '네이비게이션 추가',
        'edit'     => '네이비게이션 수정',
        'title'    => '네이비게이션 관리',
        'subtitle' => '네이비게이션 설정',
        'fields'   => [
            'parent'         => '상위 네이비',
            'active'         => '활성',
            'non_active'     => '비활성',
            'subject'        => '주제',
            'name'           => '분류명',
            'url'            => '링크',
            'description'    => '설명',
            'open_new'       => '새창',
        ],
        'msg' => [
            'msg_insert'     => '네이비가 정상적으로 추가되었습니다.',
            'msg_update'     => '네이비가 정상적으로 수정되었습니다.',
            'msg_delete'     => '네이비가 정상적으로 삭제되었습니다.',
            'msg_get'        => '네이비를 성공적으로 불러왔습니다.',
            'msg_get_fail'   => '네이비를 찾을 수 없거나 이미 삭제되었습니다.',
            'msg_fail_order' => '네이비 순서 변경에 실패했습니다.',
        ],
    ],
    /**
     * article.
     */
    'article' => [
        'add'      => '게시물 추가',
        'edit'     => '게시물 수정',
        'title'    => '게시물 관리',
        'subtitle' => '게시물 목록',
        'recycle_title' => '휴지통',
        'fields'   => [
            'category_id' => '부류',
            'title' => '제목',
            'author_id' => '작성자',
            'created_at' => '작성일',
            'status'     => '상태',
            'active'     => '활성',
            'non_active'     => '비활성',
            'author_id'  => '작성자',
        ],
        'msg' => [
            'msg_insert'   => '게시물가 정상적으로 추가되었습니다.',
            'msg_update'   => '게시물가 정상적으로 수정되었습니다.',
            'msg_delete'   => '게시물가 정상적으로 삭제되었습니다.',
            'msg_get'      => '게시물를 성공적으로 불러왔습니다.',
            'msg_get_fail' => '게시물를 찾을 수 없거나 이미 삭제되었습니다.',
            'msg_permission_fail' => '접근 권한 없음.',
        ],
    ],
    /**
     * order.
     */
    'order' => [
        'edit'     => '신청 수정',
        'title'    => '신청 관리',
        'subtitle' => '신청 목록',
        'recycle_title' => '휴지통',
        'fields'   => [
            'order_no' => '주문 번호',
            'username' => '회원',
            'receiver_name' => '수령인',
            'receiver_phone' => '수령인 휴대전화',
            'pay_status'     => 'Pay',
            'apply_time'     => '시간',
        ],
        'msg' => [
            'msg_update'   => '정상적으로 수정되었습니다.',
            'msg_delete'   => '정상적으로 삭제되었습니다.',
            'msg_get'      => '성공적으로 불러왔습니다.',
            'msg_get_fail' => '찾을 수 없거나 이미 삭제되었습니다.',
            'msg_permission_fail' => '접근 권한 없음.',
        ],
    ],
    /**
     * family_site.
     */
    'family_site' => [
        'add'      => '사이트 추가',
        'edit'     => '사이트 수정',
        'title'    => 'Family Site 관리',
        'subtitle' => 'Family Site 목록',
        'fields'   => [
            'title' => '사이트명',
            'created_at'  => '작성일',
            'active'     => '활성',
            'non_active'     => '비활성',
            'url'  => '링크',
        ],
        'msg' => [
            'msg_insert'   => '사이트가 정상적으로 추가되었습니다.',
            'msg_update'   => '사이트가 정상적으로 수정되었습니다.',
            'msg_delete'   => '사이트가 정상적으로 삭제되었습니다.',
            'msg_delete_error'  => '사이트 삭제 중 오류가 발생했습니다.',
            'msg_get'      => '사이트를 성공적으로 불러왔습니다.',
            'msg_get_fail' => '사이트를 찾을 수 없거나 이미 삭제되었습니다.',
            'msg_permission_fail' => '접근 권한 없음.',
        ],
    ],
    /**
     * slide.
     */
    'slide' => [
        'add'      => '슬라이드 추가',
        'edit'     => '슬라이드 수정',
        'title'    => '슬라이드 관리',
        'subtitle' => '슬라이드 목록',
        'fields'   => [
            'title' => '제목',
            'code' => '코드',
            'created_at'  => '작성일',
            'active'     => '활성',
            'non_active'     => '비활성',
            'url'  => '링크',
            'subject'        => '주제',
            'name'           => '분류명',
            'url'            => '링크',
            'description'    => '설명',
            'content'    => '내용',
            'video'    => '비디오',
            'open_new'       => '새창',
            'autoplay'       => '자동재생',
            'loop'           => '반복재생',
            'delay'          => '지연시간 (ms)',
            'speed'          => '전환속도 (ms)',
            'pagination'    => '페이지네이션',
            'navigation'    => '네비게이션',
            'scrollbar'    => '스크롤바',
        ],
        'msg' => [
            'msg_insert'   => '슬라이드가 정상적으로 추가되었습니다.',
            'msg_update'   => '슬라이드가 정상적으로 수정되었습니다.',
            'msg_delete'   => '슬라이드가 정상적으로 삭제되었습니다.',
            'msg_delete_error'  => '슬라이드 삭제 중 오류가 발생했습니다.',
            'msg_get'      => '슬라이드를 성공적으로 불러왔습니다.',
            'msg_get_fail' => '슬라이드를 찾을 수 없거나 이미 삭제되었습니다.',
            'msg_permission_fail' => '접근 권한 없음.',
        ],
    ],
    /**
     * popup.
     */
    'popup' => [
        'add'      => '팝업 추가',
        'edit'     => '팝업 수정',
        'title'    => '팝업 관리',
        'subtitle' => '팝업 목록',
        'fields'   => [
            'title' => '제목',
            'content' => '내용',
            'width' => '이미지 너비',
            'height' => '이미지 높이',
            'offset_left' => '좌우 오프셋',
            'offset_top' => '상하 오프셋',
            'show_once' => '작성일',
            'start_at'     => '시작일',
            'end_at'     => '종료일',
            'active'     => '활성',
            'location'     => '위치',
            'non_active'     => '비활성',
            'created_at'  => '작성일',
            'link'  => '링크',
        ],
        'msg' => [
            'msg_insert'   => '팝업이 정상적으로 추가되었습니다.',
            'msg_update'   => '팝업이 정상적으로 수정되었습니다.',
            'msg_delete'   => '팝업이 정상적으로 삭제되었습니다.',
            'msg_delete_error'  => '팝업 삭제 중 오류가 발생했습니다.',
            'msg_get'      => '팝업을 성공적으로 불러왔습니다.',
            'msg_get_fail' => '팝업을 찾을 수 없거나 이미 삭제되었습니다.',
            'msg_permission_fail' => '접근 권한 없음.',
        ],
    ],
    /**
     * apply.
     */
    'apply' => [
        'add'      => '상세내용',
        'edit'     => '상세내용',
        'title'    => '신청 관리',
        'fields'   => [
            'title' => '제목',
            'content' => '내용',
            'width' => '이미지 너비',
            'height' => '이미지 높이',
            'offset_left' => '좌우 오프셋',
            'offset_top' => '상하 오프셋',
            'show_once' => '작성일',
            'start_at'     => '시작일',
            'end_at'     => '종료일',
            'active'     => '활성',
            'location'     => '위치',
            'non_active'     => '비활성',
            'created_at'  => '작성일',
            'link'  => '링크',
        ],
        'msg' => [
            'msg_insert'   => '정상적으로 추가되었습니다.',
            'msg_update'   => '정상적으로 수정되었습니다.',
            'msg_delete'   => '정상적으로 삭제되었습니다.',
            'msg_delete_error'  => '삭제 중 오류가 발생했습니다.',
            'msg_get'      => '성공적으로 불러왔습니다.',
            'msg_get_fail' => '찾을 수 없거나 이미 삭제되었습니다.',
            'msg_permission_fail' => '접근 권한 없음.',
        ],
    ],
    /**
     * user.
     */
    'user' => [
        'add'      => '사용자 추가',
        'edit'     => '사용자 수정',
        'title'    => '사용자 관리',
        'subtitle' => '사용자 목록',
        'fields'   => [
            'active'     => '활성',
            'role'     => '역할',
            'profile'    => '프로필',
            'join'       => '가입일',
            'setting'    => '설정',
            'non_active' => '비활성',
        ],
        'msg' => [
            'msg_insert'   => '사용자가 정상적으로 추가되었습니다.',
            'msg_update'   => '사용자가 정상적으로 수정되었습니다.',
            'msg_delete'   => '사용자가 정상적으로 삭제되었습니다.',
            'msg_get'      => '사용자를 성공적으로 불러왔습니다.',
            'msg_get_fail' => '사용자를 찾을 수 없거나 이미 삭제되었습니다.',
            'msg_permission_fail' => '접근 권한 없음.',
        ],
    ],
    /**
     * media.
     */
    'media' => [
        'msg' => [
            'invalid_file_type'   => '파일 유형 확인 하십시오.',
            'file_too_large'   => '파일 용량 확인 하십시오.',
        ],
    ],
    /**
     * contact.
     */
    'contact' => [
        'title'    => '문의 관리',
        'subtitle'    => '문의 목록',
        'fields'   => [
            'code'       => '폼 코드',
            'ip'   => '폼 수신 이메일',
            'user_agent'   => '수신 성공 메시지',
            'created_at' => '작성일',
        ],
        'msg' => [
            'invalid_file_type'   => '파일 유형 확인 하십시오.',
            'file_too_large'   => '파일 용량 확인 하십시오.',
        ],
    ],
    
    /**
     * contact.
     */
    'site' => [
        'title'    => '사이트 관리',
        'subtitle'    => '사이트 목록',
        'add'   => '사이트 추가',
        'fields'   => [
            'name'       => '사이트 이름',
            'theme'   => '템플릿 코드',
            'status'   => '상태',
            'created_at' => '작성일',
            'domain' => '도메인',
            'description' => '설명',
        ],
        'msg' => [
            'invalid_file_type'   => '파일 유형 확인 하십시오.',
            'file_too_large'   => '파일 용량 확인 하십시오.',
        ],
    ],
    /**
     * form.
     */
    'form' => [
        'add'      => '폼 추가',
        'edit'     => '폼 수정',
        'title'    => '폼 관리',
        'subtitle'    => '폼 목록',
        'fields'   => [
            'active'     => '활성',
            'lang'       => '언어',
            'non_active'     => '비활성',
            'name'       => '폼 이름',
            'code'       => '폼 코드',
            'submit_email'   => '폼 수신 이메일',
            'success_message'   => '수신 성공 메시지',
            'created_at' => '작성일',
            'version' => '버전',
            'select_file' => '파일 선택',
            'file_max_size' =>'파일 크기 제한 : {0}'
        ],
        'msg' => [
            'msg_insert'   => '폼가 정상적으로 추가되었습니다.',
            'success'   => 'Success',
            'timeout'   => '폼이 만료되었습니다, 페이지를 새로 고치십시오',
            'msg_update'   => '폼가 정상적으로 수정되었습니다.',
            'msg_delete'   => '폼가 정상적으로 삭제되었습니다.',
            'msg_get'      => '폼를 성공적으로 불러왔습니다.',
            'msg_get_fail' => '폼를 찾을 수 없거나 이미 삭제되었습니다.',
            'msg_permission_fail' => '접근 권한 없음.',
            'err_required'     => '{0} 는 필수 항목입니다.',
            'err_valid_email'  => '{0} 형식이 올바르지 않습니다.',
            'err_uploaded'     => '파일을 업로드해주세요.',
            'err_max_size'     => '파일 크기가 너무 큽니다.',
            'err_ext_in'       => '파일 형식이 허용되지 않습니다.',
            'err_too_fast'      =>'폼 제출이 너무 빈번합니다, {0}분 후에 다시 시도하십시오.',
        ],
    ],
    /**
     * formfield.
     */
    'formfield' => [
        'title'    => '폼 항목관리',
        'subtitle'    => '폼 항목목록',
        'fields'   => [
        ],
        'msg' => [
            'msg_insert'   => '폼가 정상적으로 추가되었습니다.',
            'msg_update'   => '폼가 정상적으로 수정되었습니다.',
            'msg_permission_fail' => '접근 권한 없음.',
        ],
    ],
    /**
     * config.
     */
    'config' => [
        'title'    => '기본환경설정',
        'fields'   => [
            'homepage_setting'             => '홈페이지 기본화경 설정',
            'file_upload'             => '파일 업로드 설정',
            'email_notification'             => '이메일 알림 설정',
            'map'             => '지도 설정',
            'kakao_login'             => '카카오 로그인',
            'naver_login'             => '네이버 로그인',
            'company_name'          => '회사명',
            'company_name_en'       => '영문 화사명',
            'company_ceo'           => '대표자',
            'company_phone'         => '대표번호',
            'company_email'         => '이메일',
            'company_base_email'    => '이메일',
            'company_phone1'         => '대표번호1',
            'company_email1'         => '이메일1',
            'company_phone2'         => '대표번호2',
            'company_email2'         => '이메일2',
            'company_phone3'         => '대표번호3',
            'company_email3'         => '이메일3',

            'company_fax'           => '대표 팩스',
            'company_address'       => '주소',
            'company_address1'       => '주소1',
            'company_address2'       => '주소2',
            'company_address3'  =>'주소3',
            
            'company_number'        => '사업자 번호',
            'company_sales_number'  => '통신판매자 번호',
            'meta_tags'             => '추가 메타태그',
            'meta_keywords'         => '키워드',
            'meta_description'      => '소개글',
            'og_image'              => '표시 이미지',
            'user_privacy'          => '회원가입약관',
            'user_stipulation'      => '개인정보처리방침',
            'email_from'            => '발신 이메일',
            'email_from_name'       => '발신자 이름',
            'email_protocol'        => '발신 약관',
            'email_smtp_host'       => 'SMTP 서버',
            'email_smtp_user'       => 'SMTP 아이디',
            'email_smtp_pass'       => 'SMTP 비밀번호',
            'email_smtp_port'       => 'SMTP 포트',
            'email_send_test'       => '테스트 메일 보내기',
            'file_max_size'        => '업로드 최대 용량',
            'map_key_google'        => 'Google Map Key',
            'map_key_daum'          => 'Daum Map Key',
            'map_loaction'          => '위치',
            'favicon'               => '파비콘',
            'warning_meta_description'=>'최적는 110-160자입니다.',
            'warning_png'           => '주의! .png 만 지원됩니다.',
            'warning_jpg'           => '주의! .jpg 만 지원됩니다.',
            'warning_metatags'      => '주의! 시스템에는 이미 기본 meta tags 항목이 포함되어 있으며,추가로 설정하는 meta tags는 검색 엔진 인식 등의 목적에만 사용됩니다.',
        ],
        'msg' => [
            'invalid_file_type'   => '파일 유형 확인 하십시오.',
            'file_too_large'   => '파일 용량 확인 하십시오.',
        ],
    ],
    /**
     * seo.
     */
    'seo' => [
        'title'    => 'SEO설정',
    ],
];
