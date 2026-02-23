<?php
session_start(); // 현재 페이지에서 세션 처리를 진행한다.

# 데이터베이스 접속하기
include_once("db.php");

# 아이디, 패스워드 읽어오기
$email = isset($_POST['email']) ? $_POST['email'] : '';
$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';

# 필수 필드가 비어 있는지 확인
if (empty($email) || empty($pwd)) {
    echo "<script>alert('모든 필드를 채워주세요.')</script>";
    echo "<script>location.href='signin.html'</script>";
    exit();
}

# SQL 작성 (Prepared Statement 사용)
$sql = "SELECT * FROM member WHERE email = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    echo "<script>alert('SQL 준비 실패: " . $conn->error . "')</script>";
    echo "<script>location.href='signin.html'</script>";
    exit();
}
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0) {  // select 검색 결과가 있는 경우 
    # 로그인 사용자 정보를 가져오기
    $row = $result->fetch_assoc(); // 레코드 하나를 연관배열 형식으로 가져 옴
    
    # 비밀번호 검증
    if (password_verify($pwd, $row['pwd'])) {
        # 검색된 사용자 정보를 세션 배열에 저장하기
        $_SESSION['uid'] = $row['email'];
        $_SESSION['uname'] = $row['uname']; 
        echo "<script>alert('로그인 성공')</script>";
        echo "<script>location.href='index.php'</script>";
    } else {
        echo "<script>alert('로그인 실패: 비밀번호가 올바르지 않습니다.')</script>";
        echo "<script>location.href='signin.html'</script>";
    }
} else {
    echo "<script>alert('로그인 실패: 사용자를 찾을 수 없습니다.')</script>";
    echo "<script>location.href='signin.html'</script>";
}

$stmt->close();
$conn->close();  // DB 접속 종료
?>



