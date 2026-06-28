<?php 
namespace App\Libraries;

class SMSManager
{

    // Reference:http://trudy.kr/71
    private $smsSendUrl1 = "https://sslsms.cafe24.com/sms_sender.php"; // 전송요청 URL
    private $smsSendUrl2 = "https://sslsms.cafe24.com/sms_sender.php"; // HTTPS 전송요청 URL

    private $smsSendClintUrl1 =  "https://sslsms.cafe24.com/smsSenderPhone.php";
    private $smsReMainUrl = "http://sslsms.cafe24.com/sms_remain.php"; // 전송요청 URL
    private $smsListUrl = "http://smsapi.cafe24.com/sms_list.php"; // 전송요청 URL"

    private $userId = 'winchinasms'; //SMS 아이디.
    private $secure = 'a12fdc9986c8948e15d137da71f240d8';   //인증키
    private $sms_subject = '[윈차이나] Visa Winchina';
    private $host = '';
    private $path = '';
    private $boundary = '';
    private $header = '';
    private $headerData = '';

    private $nointeractive = '';    // 자바스크립트 Alert 관련

    private $sms1SendNumberG1 = '02';   // 발송자 국번
    private $sms1SendNumberG2 = '1234';   // 발송자 중간 번호
    private $sms1SendNumberG3 = '5678';   // 발송자 마지막 번호

    private $sms1 = array();

    private $smsResult = '';    //발송결과
    private $smsResultText = '';    //발송결과
    private $smsResultCount = '';   //발송후 잔여건수

    private $smsTotalCount = '';    // 총 잔여건수

    private $smsSendResultData = '';
    private $smsSendResultCode = '';
    private $smsSendResultReturnData = '';
    private $smsSendResultReturnDataI = '0';
    private $smsSendResultReturnData2 = '';

    private $displayLimitCnt = '50';
    private $displayLimitCntSum = '50';

    private $retrunUrl = '';

    /**
     * @brief
     *
     **/
    public function __construct()
    {

    }

    /**
     * @brief
     *
     **/
    private function setBoundary()
    {
        srand((double)microtime()*1000000);
        $this->boundary = "---------------------".substr(md5(rand(0,32000)),0,10);
        //print_r($sms);
    }

    /**
     * @brief
     *
     **/
    private function setHeader()
    {
        // 헤더 생성
        $this->header = "POST /".$this->path ." HTTP/1.0\r\n";
        $this->header .= "Host: ".$this->host."\r\n";
        $this->header .= "Content-type: multipart/form-data, boundary=".$this->boundary."\r\n";
        $this->headerData = '';
    }

    public function sendSMS($sms_send_msg, $smsType, $sms_send_mobile, $sms_send_sender, $sms_subject='') {
        $sphone = explode("-", $sms_send_sender);
        $sphone[2] = !empty($sphone[2])?$sphone[2]:'';
        $sms_data = array(
            'msg'       =>  $sms_send_msg,
            'smsType'   =>  $smsType,
            'rphone'    =>  $sms_send_mobile,
            'sphone1'   =>  $sphone[0],
            'sphone2'   =>  $sphone[1],
            'sphone3'   =>  $sphone[2],
            'testflag'  =>  ''
        );
        //var_dump($sms_data);
        $this->setSendTypeCheck($smsType, $sms_subject);
        $this->setSMS($sms_data);
        $result_text = $this->getSendResultText();
        $result = array(
            'result_code'   => $this->smsResult,
            'result_text'   => $result_text
        );

        return $result;
    }

    /**
     * @brief
     *
     **/
    // Necessary Data: msg, rphone, sphone1,2,3, returnurl, testflag
    public function setSMS($data)
    {

        // Initialize
        $data['rdate'] = !empty($data['rdate']) ? $data['rdate'] : "";
        $data['rtime'] = !empty($data['rtime']) ? $data['rtime'] : "";
        $data['destination'] = !empty($data['destination']) ? $data['destination'] : "";
        $data['repeatFlag'] = !empty($data['repeatFlag']) ? $data['repeatFlag'] : "";
        $data['returnurl'] = !empty($data['returnurl']) ? $data['returnurl'] : "";
        $data['repeatNum'] = !empty($data['repeatNum']) ? $data['repeatNum'] : "1";
        $data['repeatTime'] = !empty($data['repeatTime']) ? $data['repeatTime'] : "15";

        $this->sms1['user_id'] = base64_encode($this->userId); //SMS 아이디.
        $this->sms1['secure'] = base64_encode($this->secure) ;//인증키

        $this->sms1['msg'] = base64_encode(stripslashes($data['msg']));

        $this->sms1['rphone'] = base64_encode($data['rphone']);

        // 발신자 번호 체크
        $this->sms1['sphone1'] = base64_encode($data['sphone1']);
        $this->sms1['sphone2'] = base64_encode($data['sphone2']);
        $this->sms1['sphone3'] = base64_encode($data['sphone3']);
        //$this->setSendNumberCheck($data['sphone1'], $data['sphone2'], $data['sphone3']);

        $this->sms1['rdate'] = base64_encode($data['rdate']);
        $this->sms1['rtime'] = base64_encode($data['rtime']);
        $this->sms1['mode'] = base64_encode("1"); // base64 사용시 반드시 모드값을 1로 주셔야 합니다.
        $this->sms1['returnurl'] = base64_encode($data['returnurl']);
        $this->sms1['testflag'] = base64_encode($data['testflag']);
        $this->sms1['destination'] = urlencode(base64_encode($data['destination']));

        $this->sms1['repeatFlag'] = base64_encode($data['repeatFlag']);
        $this->sms1['repeatNum'] = base64_encode($data['repeatNum']);
        $this->sms1['repeatTime'] = base64_encode($data['repeatTime']);
        $this->sms1['smsType'] = base64_encode($data['smsType']); // LMS일경우 L
        // 웹페이지일 경우 돌아갈 주소 설정
        $this->retrunUrl = $data['returnurl'];

        //사용할 경우 : 1, 성공시 대화상자(alert)를 생략
        //$this->nointeractive = $data['nointeractive'];
        // API 요청하기
        //var_dump($data);
        $this->setAPI();
    }

    /**
     * @brief 발신번호 조합하기
     *
     **/
    private function setSendNumberCheck($number1, $number2, $number3)
    {
        if( $number1 != $this->sms1SendNumberG1 && $number2 != $this->sms1SendNumberG2 && $number3 != $this->sms1SendNumberG3 )
        {
            $this->sms1['sphone1'] = base64_encode($number1);
            $this->sms1['sphone2'] = base64_encode($number2);
            $this->sms1['sphone3'] = base64_encode($number3);
        } else {
            $this->sms1['sphone1'] = base64_encode($this->sms1SendNumberG1);
            $this->sms1['sphone2'] = base64_encode($this->sms1SendNumberG2);
            $this->sms1['sphone3'] = base64_encode($this->sms1SendNumberG3);
        }
    }

    /**
     * @brief SMS, LMS 구분, 제목 삽입여부
     *
     **/
    private function setSendTypeCheck($type, $subject='')
    {
        // LMS일경우 L , SMS일 경우 S

        // 빈값은 SMS로 판단함
        if( $type == '')
        {
            $type = 'S';
        }

        // TYPE 설정
        $this->sms1['smsType'] = base64_encode($type);

        // LMS 일경우에 제목 설정
        if($type == 'L'){
            $this->sms1['subject'] =  base64_encode($subject);
        }
        //var_dump($this->sms1['subject']);

    }

    /**
     * @brief
     *
     **/
    private function setAPI()
    {
        $host_info = explode("/", $this->smsSendUrl1);
        $this->host = $host_info[2];
        $this->path = $host_info[3];

        $this->setBoundary();

        // 헤더 생성
        $this->setHeader();

        // 본문 생성
        foreach($this->sms1 AS $index => $value){
            $this->headerData .="--".$this->boundary."\r\n";
            $this->headerData .= "Content-Disposition: form-data; name=\"".$index."\"\r\n";
            $this->headerData .= "\r\n".$value."\r\n";
            $this->headerData .="--".$this->boundary."\r\n";
        }
        $this->header .= "Content-length: " . strlen($this->headerData) . "\r\n\r\n";

        //var_dump($this->header);

        $this->setSend();
    }

    /**
     * @brief 발송요청하기
     *
     **/
    public function setSend()
    {
        $fp = fsockopen($this->host, 80);

        if ($fp)
        {
            fputs($fp, $this->header.$this->headerData);

            $rsp = '';
            while(!feof($fp)) {
                $rsp .= fgets($fp,8192);
            }
            fclose($fp);

            //var_dump($rsp);

            $msg = explode("\r\n\r\n",trim($rsp));
            $rMsg = explode(",", $msg[1]);

            $this->smsResult = $rMsg[0]; //발송결과
            $this->smsResultCount = $rMsg[1]; //잔여건수

            // 실제 전송이 되도록 요청
            $this->setSMSToClint();

        } else {

            $this->smsResult = 'Connection Failed';

        }
    }

    /**
     * @brief 잔여건수 조회
     *
     **/
    private function setCallSMSToClint()
    {

        $sms['user_id'] = base64_encode($this->userId); // SMS 아이디
        $sms['secure'] = base64_encode($this->secure) ;//인증키
        $sms['mode'] = base64_encode("1"); // base64 사용시 반드시 모드값을 1로 주셔야 합니다.

        $host_info = explode("/", $this->smsReMainUrl);
        $this->host = $host_info[2];
        $this->path = $host_info[3];

        $this->setBoundary();

        // 헤더 생성
        $this->setHeader();

        // 본문 생성
        foreach($sms AS $index => $value){
            $this->headerData .="--".$this->boundary."\r\n";
            $this->headerData .= "Content-Disposition: form-data; name=\"".$index."\"\r\n";
            $this->headerData .= "\r\n".$value."\r\n";
            $this->headerData .="--".$this->boundary."\r\n";
        }
        $this->header .= "Content-length: " . strlen($this->headerData) . "\r\n\r\n";

        $fp = fsockopen($this->host, 80);

        if ($fp) {
            fputs($fp, $this->header.$this->headerData);
            $rsp = '';
            while(!feof($fp)) {
                $rsp .= fgets($fp,8192);
            }
            fclose($fp);
            $msg = explode("\r\n\r\n",trim($rsp));
            $this->smsTotalCount = $msg[1]; //잔여건수
        }
        else {
            $this->smsTotalCount = 'Connection Failed';
        }
    }

    /**
     * @brief 발신요청 발신번호 목록 조회
     *
     **/
    private function setSMSToClint()
    {

        //CURL이 사뇽 가능한 서버에서만 사용하세요
        // CAFE24에서는 이것도 동시에 하라고 하는데 CURL이 없으면 안됩니다.
        $oCurl = curl_init();

        $aPostData['userId'] = $this->userId;
        $aPostData['passwd'] = $this->secure;

        curl_setopt($oCurl, CURLOPT_URL, $this->smsSendClintUrl1);
        curl_setopt($oCurl, CURLOPT_POST, 1);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $aPostData);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, 0);
        $ret = curl_exec($oCurl);
        //echo $ret;
        curl_close($oCurl);

    }

    /**
     * @brief
     *
     **/
    public function getSendResult()
    {
        return $this->smsResult;
    }

    /**
     * @brief
     *
     **/
    public function getSendResultText()
    {
        //발송결과 알림
        if($this->smsResult == 'success') {
            $this->smsResultText = '성공 잔여건수는 '.$this->smsResultCount.'건 입니다.';
        } else if($this->smsResult == 'reserved') {
            $this->smsResultText = '성공적으로 예약되었습니다. 잔여건수는'.$this->smsResultCount.'건 입니다.';
        } else if($this->smsResult == '-100') {
            $this->smsResultText = '서버에러';
        } else if($this->smsResult == '-201') {
            $this->smsResultText = 'sms 건수부족에러';
        } else if($this->smsResult == '0004') {
            $this->smsResultText = '메시지길이 오류';
        } else if($this->smsResult == '0099') {
            $this->smsResultText = '기타오류';
        } else if($this->smsResult == '0044') {
            $this->smsResultText = '스팸메시지 차단 유해한단어 포함';
        } else if($this->smsResult == '3202') {
            $this->smsResultText = '폰넘버오류';
        } else if($this->smsResult == '3206') {
            $this->smsResultText = '전송성공';
        } else if($this->smsResult == '3218') {
            $this->smsResultText = '메시지중복오류';
        } else if($this->smsResult == '3219') {
            $this->smsResultText = '월송신건수 초과';
        } else if($this->smsResult == '3223') {
            $this->smsResultText = '수신거부 메시지부분 없음';
        } else if($this->smsResult == '3224') {
            $this->smsResultText = '21시이후 광고';
        } else if($this->smsResult == '1') {
            $this->smsResultText = '시스템장애';
        } else if($this->smsResult == '216') {
            $this->smsResultText = '수신번호오류';
        } else if($this->smsResult == '245') {
            $this->smsResultText = '메시지전송불가';
        } else {
            $this->smsResultText = '[Error]'.$this->smsResult;
        }

        return $this->smsResultText;
    }

    /**
     * @brief
     *
     **/
    public function getSendResultCount()
    {
        return $this->smsResultCount;
    }

    /**
     * @brief
     *
     **/
    public function getTotalCount()
    {
        $this->setCallSMSToClint();
        return $this->smsTotalCount;
    }


    /**
     * @brief
     *
     **/
    public function getSendResultAlert()
    {
        $html = '';

        if($this->nointeractive == '1' && ($this->smsResult != 'success' && $this->smsResult != 'Test Success!' && $this->smsResult != 'reserved') ) {
            $html = "<script>alert('".$this->smsResultText ."')</script>";
        }
        else if($this->nointeractive!="1") {
            $html = "<script>alert('".$this->smsResultText ."')</script>";
        }

        return $html;
    }

    /**
     * @brief
     *
     **/
    public function getSendReturnUrl()
    {
        $html = '';

        $html = "<script>location.href='".$this->retrunUrl."';</script>";

        return $html;

    }

    /**
     * @brief 전송결과 조회
     *
     **/
    public function getSendResultList($data)
    {
        $this->sms2['user_id'] = $this->userId; // SMS 아이디
        $this->sms2['secure'] = $this->secure; //인증키
        $this->sms2['date'] = $data['date'];//조회 기준일  YYYYMMDD
        $this->sms2['day'] = $data['day'];//조회 범위   1 ~ 7 (최대 7일)
        $this->sms2['startNo'] = $data['startNo'];//조회 시작번호
        $this->sms2['displayNo'] = $data['displayNo'];//출력 갯수 1 ~ 50 (최대 50개)
        $this->sms2['sendType'] = $data['sendType'];//발송형태 all(구분없이) or genaral(일반발송) or reserve(예약발송)
        $this->sms2['sendStatus'] = $data['sendStatus'];//발송상태 S(발송성공) or F(발송실패)
        $this->sms2['receivePhone'] = $data['receivePhone'];//검색할 수신번호 (-)포함 010-0000-0000
        $this->sms2['sendPhone'] = $data['sendPhone'];//검색할 발신번호 (-)포함 010-0000-0000
        $this->sms2['smsType'] = $data['smsType'];// LMS, MMS 조회인경우 lms

        $host_info = explode("/", $this->smsListUrl);
        $this->host = $host_info[2];
        $this->path = $host_info[3];

        $this->setBoundary();

        // 헤더 생성
        $this->setHeader();

        // 본문 생성
        foreach($this->sms2 AS $index => $value){
            $this->headerData .="--".$this->boundary."\r\n";
            $this->headerData .= "Content-Disposition: form-data; name=\"".$index."\"\r\n";
            $this->headerData .= "\r\n".$value."\r\n";
            $this->headerData .="--".$this->boundary."\r\n";
        }
        $this->header .= "Content-length: " . strlen($this->headerData) . "\r\n\r\n";

        $fp = fsockopen($this->host, 80);
        if ($fp)
        {
            fputs($fp, $this->header.$this->headerData);
            $rsp = '';
            while(!feof($fp)) {
                $rsp .= fgets($fp,8192);
            }
            fclose($fp);
            $msg = explode("\r\n\r\n",trim($rsp));
            $this->smsSendResultData = $msg[1];

        } else {
            echo  "Connection Failed";
        }

        if( $this->smsSendResultData != '')
        {
            $this->parserXML();
        } else {
            $this->smsSendResultReturnData2 = "Connection Failed";
        }

    }

    /**
     * @brief XML 목록을 파싱해서 배열로 전환
     *
     **/
    private function parserXML()
    {
        $dom = new DOMDocument;
        $dom->loadXML($this->smsSendResultData);
        $xml = simplexml_import_dom($dom);

        // 결과 코드
        $this->smsSendResultCode = $xml->code;

        // 결과값 가공
        $i = $this->smsSendResultReturnDataI;
        foreach($xml->data->record as $key=>$value)
        {
            // 발송형태 값과 한글 처리
            $this->smsSendResultReturnData[$i]['sendType'] = (string) $value->sendType;
            switch($value->sendType) {
                case "I" :
                    $this->smsSendResultReturnData[$i]['sendTypeText'] = "일반발송";
                    break;
                case "R" :
                    $this->smsSendResultReturnData[$i]['sendTypeText'] = "예약발송";
                    break;
            }

            // 발신자 번호
            $this->smsSendResultReturnData[$i]['sendPhone'] = (string) $value->sendPhone;

            // 수신자 번호
            $this->smsSendResultReturnData[$i]['receivePhone'] = (string) $value->receivePhone;

            // 문자내용
            $this->smsSendResultReturnData[$i]['msg'] = (string) $value->msg;

            // 발송시간과, 발송시간 유닉스 시간
            $dateYear = substr($value->sendDateTime,0,4);
            $dateMonth = substr($value->sendDateTime,4,2);
            $dateDay = substr($value->sendDateTime,6,2);
            $dateHour = substr($value->sendDateTime,8,2);
            $dateMin = substr($value->sendDateTime,10,2);
            $datetime = $dateYear.'-'.$dateMonth.'-'.$dateDay.' '.$dateHour.':'.$dateMin.':00';
            $stampTime = strtotime($datetime);

            $this->smsSendResultReturnData[$i]['sendDateTime'] = $datetime;
            $this->smsSendResultReturnData[$i]['sendStamptime'] = $stampTime;

            // 등록시간과, 등록시간 유닉스 시간
            $this->smsSendResultReturnData[$i]['regDate'] = (string) $value->regDate;
            $stampTime = strtotime( $this->smsSendResultReturnData[$i]['regDate'] );
            $this->smsSendResultReturnData[$i]['regStamptime'] = $stampTime;

            // 발송결과 값과 한글처리
            $this->smsSendResultReturnData[$i]['sendStatus'] = (string) $value->sendStatus;
            switch($value->sendStatus) {
                case "1" :
                    $this->smsSendResultReturnData[$i]['sendStatusText'] = "일반발송 요청";
                    break;
                case "2" :
                    $this->smsSendResultReturnData[$i]['sendStatusText'] = "예약발송 요청";
                    break;
                case "3" :
                    $this->smsSendResultReturnData[$i]['sendStatusText'] = "발송성공";
                    break;
                case "9" :
                    $this->smsSendResultReturnData[$i]['sendStatusText'] = "발송실패";
                    break;
            }

            //refundDate     실패건 재충전 시간
            if( $value->refundDate != '')
            {
                $dateYear = substr($value->refundDate,0,4);
                $dateMonth = substr($value->refundDate,4,2);
                $dateDay = substr($value->refundDate,6,2);
                $dateHour = substr($value->refundDate,8,2);
                $dateMin = substr($value->refundDate,10,2);
                $datetime = $dateYear.'-'.$dateMonth.'-'.$dateDay.' '.$dateHour.':'.$dateMin.':00';
                $stampTime = strtotime($datetime);

                $this->smsSendResultReturnData[$i]['refundDate'] = $datetime;
                $this->smsSendResultReturnData[$i]['refundStamptime'] = $stampTime;
            } else {
                $this->smsSendResultReturnData[$i]['refundDate'] = '';
                $this->smsSendResultReturnData[$i]['refundStamptime'] = '';
            }

            // 배열 증가
            $i++;
        }

        $this->smsSendResultReturnDataI = $i;

        // 50개면은 다음것도 조회하자
        $displayCnt = count($this->smsSendResultReturnData);
        echo Chr(10).'displayCnt: '.$displayCnt;

        if( $displayCnt % $this->displayLimitCnt == 0)
        {

            $tmp = $this->sms2['startNo'] + 1;    // 페이지 번호 변ㄱㅇ
            $this->sms2['startNo'] = (string)  $tmp;

            $this->getSendResultList($this->sms2);  // 요청

        } else {
            $this->smsSendResultReturnData2 = $this->smsSendResultReturnData;
        }

    }

    /**
     * @brief 전송결과 조회 - 결과코드
     *
     **/
    public function getSendResultListData()
    {
        if( empty($this->smsSendResultReturnData2) == false)
        {
            return $this->smsSendResultReturnData2;
        }
    }

    /**
     * @brief 전송결과 조회 - 결과코드
     *
     * 0000     요청성공
     * -101     변수 부족 에러
     * -102     인증에러
     **/
    public function getSendResultCode()
    {

        return $this->smsSendResultCode;
    }

    /**
     * @brief
     *
     **/
    public function __destruct() {

    }

} 