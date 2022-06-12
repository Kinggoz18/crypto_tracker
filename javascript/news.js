"use strict";
let newsArry =[];
let news_Data =[];
let news =[];
function getNews()
{
    let url= "https://cryptopanic.com/api/v1/posts/?auth_token=b44a7f73a7500ba81032dfa75b6bb7a1f7d1b7ec";
    fetch("./getNews.php?url="+url,{method: 'GET'}).then(
        (resp)=>{
            if(!resp.ok){
                console.log(resp.statusText);
            }
            else{
                return resp.json();
            }
        }
    ).then((resp)=>{
        let temp =  resp['results'];
            temp.forEach(Element=>{
                let temp_source = Element['source'];
                let source = temp_source['domain'];
                let current ={
                    "title": Element['title'],
                    "date": Element['published_at'],
                    "source": source,
                };
                news_Data.push(current);
            });
            loadNews();
    })
    .catch(error=>{
        console.error(error);
    });
}
function loadNews(){
    news_Data.forEach(Element=>{
        let current =`<div class="news_box">
        <div>${Element.title}</div>
        <div>${Element.date}</div>
        <a href="https://${Element.source}" target="_blank">Source: ${Element.source}</a>
        </div>`;
        $('.news_container').append(current);
    });
}
$(document).ready(function(){
    getNews();
});