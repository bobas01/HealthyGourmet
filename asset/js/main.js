const burger = document.getElementById('burger')
const phoneMenu = document.getElementById('mainMenuPhone')

const breakfast = document.getElementById('breakfastPhone')
const secondTabBreakfast = document.getElementById('secondTabBreakfastPhone')
const starter = document.getElementById('starterPhone')
const secondTabStarter = document.getElementById('secondTabStarterPhone')
const dish = document.getElementById('dishPhone')
const secondTabDish = document.getElementById('secondTabDishPhone')
const desert = document.getElementById('desertPhone')
const secondTabDesert = document.getElementById('secondTabDesertPhone')
const searchButtonPhone = document.getElementById('searchButtonPhone')
const searchButton = document.getElementById('searchButton')
const searchBar = document.getElementById('searchBar')
const searchBarPhone = document.getElementById('searchBarPhone')

const containerConnect = document.getElementById('containerConnect')
const containerConnectPhone = document.getElementById('containerConnectPhone')
const containerRegister = document.getElementById('containerRegister')
const containerRegisterPhone = document.getElementById('containerRegisterPhone')
const iconConnect = document.getElementById('iconConnect')
const iconConnectPhone = document.getElementById('iconConnectPhone')
const subscription = document.getElementById('subscription')
const subscriptionPhone = document.getElementById('subscriptionPhone')
const connection = document.getElementById('connection')
const connectionPhone = document.getElementById('connectionPhone')
const closeRegister = document.getElementById('closeRegister')
const closeRegisterPhone = document.getElementById('closeRegisterPhone')
const closeConect = document.getElementById('closeConect')
const closeConectPhone = document.getElementById('closeConectPhone')




burger.addEventListener('click', function () {
  phoneMenu.classList.toggle('active');
})
breakfast.addEventListener('click', function () {
  secondTabBreakfast.classList.toggle('active3');
})
starter.addEventListener('click', function () {
  secondTabStarter.classList.toggle('active4');
})
dish.addEventListener('click', function () {
  secondTabDish.classList.toggle('active5');
})
desert.addEventListener('click', function () {
  secondTabDesert.classList.toggle('active6');
})
searchButton.addEventListener('click', function () {
  searchBar.classList.toggle('active7');
})
searchButtonPhone.addEventListener('click', function () {
  searchBarPhone.classList.toggle('active10');
})


iconConnect.addEventListener('click', function (e) {
  e.preventDefault()
  containerConnect.classList.toggle('active8');

})
subscription.addEventListener('click', function () {
  containerRegister.classList.toggle('active9');
  containerConnect.classList.toggle('active8');

})
connection.addEventListener('click', function () {
  containerConnect.classList.toggle('active8');
  containerRegister.classList.toggle('active9');
})
closeConect.addEventListener('click', function () {
  containerConnect.classList.toggle('active8');

})
closeRegister.addEventListener('click', function () {

  containerRegister.classList.toggle('active9');
})
iconConnectPhone.addEventListener('click', function () {
  containerConnectPhone.classList.toggle('active11');

})
subscriptionPhone.addEventListener('click', function () {
  containerRegisterPhone.classList.toggle('active12');
  containerConnectPhone.classList.toggle('active11');

})
connectionPhone.addEventListener('click', function () {
  containerConnectPhone.classList.toggle('active11');
  containerRegisterPhone.classList.toggle('active12');
})
closeConectPhone.addEventListener('click', function () {
  containerConnectPhone.classList.toggle('active11');

})
closeRegisterPhone.addEventListener('click', function () {

  containerRegisterPhone.classList.toggle('active12');
})

submitRecipe.addEventListener('click', function(){
  addIngredients.classList.toggle('activeIngredient')
})


// const addRecipe = document.getElementById('addRecipe')
// const addIngredients = document.getElementById('addIngredients')
// const submitRecipe = document.getElementById('submitRecipe')

// formAddRecipe.addEventListener('click', function () {
//  addIngredients.classList.toggle('activeIngredient');
// })
