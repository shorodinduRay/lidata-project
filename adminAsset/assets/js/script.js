'use strict';

//USE SEE MORE TO VIEW MORE TEXT
function readMore() {
  const dots = document.getElementById('dots');
  const moreText = document.getElementById('more');
  const btnText = document.getElementById('seeMoreBtn');

  if (dots.style.display === 'none') {
    dots.style.display = 'inline';
    btnText.innerHTML = 'See more';
    moreText.style.display = 'none';
  } else {
    dots.style.display = 'none';
    btnText.innerHTML = 'See less';
    moreText.style.display = 'inline';
  }
}

//SHOW PASSWORD
function showPassword() {
  let x = document.getElementById('password');
  if (x.type === 'password') {
    x.type = 'text';
  } else {
    x.type = 'password';
  }
}

//CONTACT FORM
$('.js-input').keyup(function () {
  if ($(this).val()) {
    $(this).addClass('not-empty');
  } else {
    $(this).removeClass('not-empty');
  }
});

//SEE MORE BUTTON
// function readMore() {
//   let dots = document.getElementById('dots');
//   let moreText = document.getElementById('more');
//   let btnText = document.getElementById('seeMoreBtn');

//   if (dots.style.display === 'none') {
//     dots.style.display = 'inline';
//     btnText.innerHTML = 'See more';
//     moreText.style.display = 'none';
//   } else {
//     dots.style.display = 'none';
//     btnText.innerHTML = 'See less';
//     moreText.style.display = 'inline';
//   }
// }

//Import contacts button

// document.getElementById('selectButton2').addEventListener('click', openDialog);

// function openDialog() {
//   document.getElementById('fileid2').click();
// }

// const selectBtn = document.getElementById('selectButton');
// const fileBtn = document.getElementById('fileid');
// const importBtn = document.getElementById('importButton');

// selectBtn.addEventListener('click', openDialog);
// function openDialog() {
//   fileBtn.click();

//   fileBtn.addEventListener('change', showImportBtn);

//   function showImportBtn(event) {
//     importBtn.classList.remove('hide');
//     selectBtn.classList.add('hide');
//   }
// }

// const selectBtn2 = document.getElementById('selectButton2');
// const fileBtn2 = document.getElementById('fileid2');
// const importBtn2 = document.getElementById('importButton2');

// selectBtn2.addEventListener('click', openDialog2);
// function openDialog2() {
//   fileBtn2.click();

//   fileBtn2.addEventListener('change', showImportBtn2);

//   function showImportBtn2(event) {
//     importBtn2.classList.remove('hide');
//     selectBtn2.classList.add('hide');
//   }
// }
