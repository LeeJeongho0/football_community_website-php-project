document.addEventListener("DOMContentLoaded", () => {
  const complete = document.querySelector("#complete");
  const btn_excel = document.querySelector("#btn_excel");
  complete.addEventListener("click", () => {
    if (!document.board_form.subject.value) {
      alert("제목을 입력하세요!");
      document.board_form.subject.focus();
      return;
    }
    if (!document.board_form.content.value) {
      alert("내용을 입력하세요!");
      document.board_form.content.focus();
      return;
    }
    document.board_form.submit();
  });
  btn_excel.addEventListener("click", () => {
    self.location.href = "./board_to_excel.php";
  });
});
