//gloabl variable
let dummy_strain_input
let dummy_searchWrapper


//product event listener
if (document.getElementById("product_search") != null){
    const product_search = document.getElementById("product_search");
    const searchWrapper1 = document.querySelector(".search-input");
    const suggBox1 = searchWrapper1.querySelector(".autocom-box");
    product_search.addEventListener("click", autocomplete(product_search, searchWrapper1, suggBox1));
}


//strain 1, 2, 3, 4 event listener
if (document.getElementById("strain1") != null){
    const strain1 = document.getElementById("strain1");
    const searchWrapper1 = document.querySelector(".search-input");
    const suggBox1 = searchWrapper1.querySelector(".autocom-box");
    strain1.addEventListener("click", autocomplete(strain1, searchWrapper1, suggBox1));
}

if (document.getElementById("strain2") != null){
    const strain2 = document.getElementById("strain2");
    const searchWrapper2 = document.querySelector(".search-input2");
    const suggBox2 = searchWrapper2.querySelector(".autocom-box2");
    strain2.addEventListener("click", autocomplete(strain2, searchWrapper2, suggBox2));
}

if (document.getElementById("strain3") != null){
    const strain3 = document.getElementById("strain3");
    const searchWrapper3 = document.querySelector(".search-input3");
    const suggBox3 = searchWrapper3.querySelector(".autocom-box3");
    strain3.addEventListener("click", autocomplete(strain3, searchWrapper3, suggBox3));
}

if (document.getElementById("strain4") != null){
    const strain4 = document.getElementById("strain4");
    const searchWrapper4 = document.querySelector(".search-input4");
    const suggBox4 = searchWrapper4.querySelector(".autocom-box4");
    strain4.addEventListener("click", autocomplete(strain4, searchWrapper4, suggBox4));
}



function autocomplete(box, searchWrapper, suggBox) {
    box.onkeyup = (e)=>{
        let userData = e.target.value; //user entered data
        let emptyArray = [];
        dummy_strain_input = box;
        dummy_searchWrapper = searchWrapper;
        
        if(userData){
            emptyArray = suggestions.filter((data)=>{
                //filtering array value and user char to lowercase and return only those word/sentence which starts with user entered word
                return data.toLocaleLowerCase().includes(userData.toLocaleLowerCase());
            });
            emptyArray = emptyArray.map((data)=>{
                return data = '<li>'+ data +'</li>';
            });
            console.log(emptyArray);
            searchWrapper.classList.add("active"); //show autocomplete box
            showSuggestions(emptyArray, suggBox);
            let allList = suggBox.querySelectorAll("li");
            for (let i = 0; i < allList.length; i++){
                //adding onclick attribute in all li tag
                allList[i].setAttribute("onclick", "select(this)");
                
            }
        }else{
            searchWrapper.classList.remove("active"); //hide autocomplete box
        }
    }
}


function select(element){
    let selectUserData = element.textContent;
    dummy_strain_input.value = selectUserData; //passing the user selected list item data in the field
    dummy_searchWrapper.classList.remove("active"); //hide autocomplete box
}

function showSuggestions(list, suggBox){
    let listData;
    if(!list.length){
        userValue = dummy_strain_input.value;
        listData = '<li>'+ userValue +'</li>';
    }else{
        listData = list.join('');
    }
    suggBox.innerHTML = listData;
}