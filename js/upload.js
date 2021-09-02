var validateType = function(file){
    return (['image/jpeg','image/jpg','image/png','image/gif', 'image/svg'].indexOf(file.type) > -1);
  }
// 파일 선택 필드에 이벤트 리스너 등록
document.getElementById('fileSelector').addEventListener('change', function(e){
    let elem = e.target;
    if(validateType(elem.files[0])){
        let preview = document.querySelector('.thumb');
        preview.src = URL.createObjectURL(elem.files[0]); //파일 객체에서 이미지 데이터 가져옴.
        
        
    }else{
      console.log('이미지 파일이 아닙니다.');
    }
  });

