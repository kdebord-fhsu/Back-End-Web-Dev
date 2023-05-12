const mongoose = require('mongoose');

const stateSchema = new mongoose.Schema({
    stateCode: {
        type: String,
        required: true,
        unique: true,
    },
    funfacts: [{
        type: String,
    }],
});

module.exports = mongoose.model('States', stateSchema);

app.post('/states/:state/funfact', (req, res) => {
    const stateCode = req.params.state;
    const funFacts = req.body.funfacts;
  
    // Use findOneAndUpdate to find the state by stateCode and update its funfacts array
    State.findOneAndUpdate(
      { stateCode: stateCode },
      { $push: { funfacts: { $each: funFacts } } },
      { new: true },
      (err, state) => {
        if (err) {
          // Handle error
          console.error(err);
          res.status(500).json({ error: 'Error updating state fun facts.' });
        } else if (!state) {
          // Handle case where state is not found
          res.status(404).json({ error: 'State not found.' });
        } else {
          // Return updated state object with new fun facts array
          res.json(state);
        }
      }
    );
  });
  