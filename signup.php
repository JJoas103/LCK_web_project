<?php
# 데이터베이스 접속하기
include_once("db.php"); // db.php 파일을 포함

# 입력양식의 데이터를 읽어오기
$email = $_POST['email'];
$uname = $_POST['username']; // HTML 폼의 필드 이름과 일치시킴
$pwd = $_POST['password']; // HTML 폼의 필드 이름과 일치시킴
$telno = $_POST['phone']; // HTML 폼의 필드 이름과 일치시킴
$today = date("Y-m-d");  // 컴퓨터의 현재 날짜 년-월-일 형식
$point = 5000;

# 비밀번호 해시 처리
$hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);

# member 테이블에 신규 회원 등록(추가)
$sql = "INSERT INTO member (email, uname, pwd, telno, reg_date, point) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $email, $uname, $hashed_pwd, $telno, $today, $point);

if ($stmt->execute()) {
    echo "<script>alert('회원가입 성공')</script>";
    echo "<script>location.href='index.php'</script>";
} else {
    echo "<script>alert('회원가입 실패')</script>";
    echo "<script>location.href='signup.html'</script>";
}
$stmt->close();
$conn->close();
?>




