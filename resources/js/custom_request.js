import axios from 'axios';

const loaderOverlay = document.getElementById('overlay_global');
const loaderLoader = document.getElementsByClassName('loader')[0];

export default {
    loaderStart: () => loaderLoader.style.visibility = loaderOverlay.style.visibility = 'visible',
    loaderStop: () => loaderLoader.style.visibility = loaderOverlay.style.visibility = 'hidden',
    requestGet: function (url,callback){
        this.loaderStart()
        axios.get(`${url}`,{
            headers: {
                'Content-Type': 'application/json',
            },
        }).then((response) => {
            this.loaderStop();
            if (Object.keys(callback).length === 0) {
                callback(response.data);
            }
        }).catch((error) => {
            console.error('Error:', error);
            this.loaderStop();
        });
    },
}





