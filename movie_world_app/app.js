const express = require('express');
const app = express();
const port = 3000;
const userRoutes = require('./routes/movieWorldRoutes');

app.listen(port,()=>{
    console.log('App is running at http://localhost:'+port);
})

app.get('/', (req,res)=>{
    res.send('Server is in state running');
})

app.use('/', userRoutes);
