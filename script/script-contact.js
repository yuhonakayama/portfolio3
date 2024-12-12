const form = document.getElementById('form');
const submitButton = document.querySelector('.submitButton');

form.addEventListener('input', () => {
  // 必須項目が全て入力されているか確認
  const isValid = form.checkValidity();
  console.log('Form validity:', isValid); // デバッグ用

  // ボタンのdisabled属性を切り替える
  if (isValid) {
    submitButton.disabled = false; // ボタンを有効化
    console.log('Button enabled'); // デバッグ用
  } else {
    submitButton.disabled = true; // ボタンを無効化
    console.log('Button disabled'); // デバッグ用
  }
});
