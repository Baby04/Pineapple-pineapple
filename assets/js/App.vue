 <template> 
    <div> 
      <h2>Welcome home</h2>
      <button @click="counter++"> click me {{ counter }}</button>
    </div> 
 </template>

  <script>
   export default {
       data: () => ({
           counter: 0
       })
   } 
 </script>

 <style>
 
 </style>