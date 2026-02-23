// article 엘리먼트들을 가져온다
//const articles = document.querySelectorAll('article'); // 배열로 생성
const articles = document.getElementsByTagName('article');
const aside = document.querySelector('aside');
const close = document.querySelector('.close');

// articles에 있는 각 article에 대해서 
for(let i=0; i<4; i++) {
    // mouseenter, mouseleave 이벤트리스너 등록
    articles[i].addEventListener('mouseenter', e=>{
        // callback 함수 바디 영역
        e.currentTarget.querySelector('video').play();
    });
    articles[i].addEventListener('mouseleave', e=>{
        // callback 함수 바디 영역
        e.currentTarget.querySelector('video').pause();
    });
    articles[i].addEventListener('click', e=>{
        const title = e.currentTarget.querySelector('h2').innerText;
        const text = e.currentTarget.querySelector('p').innerText;
        const vid = e.currentTarget.querySelector('video').getAttribute('src');

        aside.querySelector('h1').innerText = title;
        aside.querySelector('p').innerText = text;
        aside.querySelector('video').setAttribute('src', vid);
        aside.classList.add('on'); // on 클래스명 추가. css 적용
        aside.querySelector('video').play();
    });

    close.addEventListener('click', e=>{
        aside.classList.remove('on');
        aside.querySelector('video').pause();
    });
}