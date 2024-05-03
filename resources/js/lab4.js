import custom_request from "./custom_request";

const RESULT_BLOCK = document.getElementsByClassName('result_lab_4')[0];

const showResult = (data)=>{
    RESULT_BLOCK.textContent = JSON.stringify(data, null, 2);
}


custom_request.requestGet('/api/v1/lab4/get-all', showResult);