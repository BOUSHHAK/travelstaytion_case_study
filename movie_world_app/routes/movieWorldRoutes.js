const express = require('express');
const router = express.Router();
const mysql = require('mysql')

const db = mysql.createConnection({
    host:'localhost',
    user: 'root',
    database: 'movieworld_db',
    port: 3306
})

db.connect((err)=>{
    if (err){
        console.error('Error connecting to MySQL: '+err.stack);
        return;
    }
    console.log('Connected to MySQL database');
})

router.use(express.json());

router.get('/movies', (req,res)=>{
    let sort = req.query.sort;
    const user_id = req.query.user_id;
    let defaultSort = 'm.dateOfPublication DESC';

    if (sort === 'likes'){
        defaultSort = 'likes DESC';
    } else if (sort === 'hates'){
        defaultSort = 'hates DESC';
    }

    const query=`SELECT m.id, m.title, m.description, m.dateOfPublication, m.user_id, u.username AS userName, (SELECT COUNT(*) FROM opinions o WHERE o.movie_id = m.id AND o.type = "like") AS likes, (SELECT COUNT(*) FROM opinions o WHERE o.movie_id = m.id AND o.type = "hate") AS hates, (SELECT o.type FROM opinions o WHERE o.user_id = ? AND o.movie_id = m.id) AS opinion FROM movies m JOIN users u ON m.user_id = u.id ORDER BY ${defaultSort};`;
    db.query(query, [user_id],(err, results)=>{
        if (err){
            res.status(500).send(err.message);
            return;
        }
        res.json(results);    
    })
})

router.post('/login', (req,res)=>{
    const {username, password} = req.body;
    const query='SELECT * FROM users WHERE username=? AND password=?';
    db.query(query, [username, password], (err, results)=>{
        if (err){
            res.status(500).send(err.message);
            return;
        }
        if(results.length === 1){
            const user = results[0];
            
            res.status(200).json({
                userID: user.id,
                username: user.username,
                redirect: 'index.php'
            });
        }else {
            res.status(401).json({redirect: 'login.php', message: 'Wrong username or password' });        
        }
    });
});

router.post('/signup', (req,res)=>{
    const {username, password} = req.body;
    const query='SELECT * FROM users WHERE username=?';
    db.query(query, [username], (err, results)=>{
        if (err){
            res.status(500).send(err.message);
            return;
        }
        if(results.length === 0){
            const inserQuery='INSERT INTO users (username, password) VALUES(?,?)';
            db.query(inserQuery, [username, password], (err, results)=>{
                if (err){
                    res.status(500).send(err.message);
                    return;
                }
                res.status(200).json({
                    redirect: 'login.php',
                    message: 'Registered successfully! Now you can log in'
                });
            });
        }else {
            res.status(401).json({redirect: 'signup.php', message: 'Username already exists! Try again!' });        
        }
    });

})
router.post('/addMovie', (req,res)=>{
    const {title, description, user_id} = req.body;
    const query='INSERT INTO movies (title, description, user_id) VALUES(?,?,?)';
    db.query(query, [title, description, user_id], (err, results)=>{
        if (err){
            res.status(500).send(err.message);
            return;
        }  
        res.json({redirect: 'index.php' , message: 'Movie added successfully'});
    });
});

router.post('/opinion', (req,res)=>{
    const {user_id, movie_id, type} = req.body;
    const query = 'SELECT user_id, type FROM opinions WHERE movie_id=? AND user_id=?';
    
    db.query(query, [movie_id, user_id], (err, results) => {
        if (err) {
            res.status(500).send(err.message);
            return;
        }

        if (results.length === 0) {
            const insertQuery = 'INSERT INTO opinions (user_id, movie_id, type) VALUES(?,?,?)';
            db.query(insertQuery, [user_id, movie_id, type], (err, results) => {
                if (err) {
                    res.status(500).send(err.message);
                    return;
                }  
                res.status(200).json({success: true, redirect: 'index.php'});
            });
        } else {
            const opinion_type = results[0].type;
            if (opinion_type === type) {
                const deleteQuery = 'DELETE FROM opinions WHERE movie_id=? AND user_id=?';
                db.query(deleteQuery, [movie_id, user_id], (err, results) => {
                    if (err) {
                        res.status(500).send(err.message);
                        return;
                    }  
                    res.status(200).json({success: true, redirect: 'index.php'});
                });
            } else {
                const updateQuery = 'UPDATE opinions SET type=? WHERE movie_id=? AND user_id=?';
                db.query(updateQuery, [type, movie_id, user_id], (err, results) => {
                    if (err) {
                        res.status(500).send(err.message);
                        return;
                    }  
                    res.status(200).json({success: true, redirect: 'index.php'});
                });
            }
        }
    });
});


module.exports = router;