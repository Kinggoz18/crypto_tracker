"use strict";
let newsArry =[];
let news_Data =[];
let news =[];
function getNews()
{
    $.ajax({
        url: "https://cryptopanic.com/api/v1/posts/?auth_token=b44a7f73a7500ba81032dfa75b6bb7a1f7d1b7ec",
        type: "GET",
        success: function(result){
            let temp =  result['results'];
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
        },
        complete: function(){
            loadNews();
        }   
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