from flask import Flask, request, jsonify
from PIL import Image
import random
import os

app = Flask(__name__)

# Simplified categories for dummy testing
categories = {
    0: {
        "label": "Organic",
        "recycle_info": "You can compost organic waste to make fertilizer.",
        "points": 10
    },
    1: {
        "label": "Inorganic",
        "recycle_info": "This waste should be recycled properly at designated facilities.",
        "points": 15
    },
}

@app.route('/')
def hello_world():
    return 'Hello, World! Waste Detection API is running.'

@app.route('/predict', methods=['POST'])
def predict():
    if 'image' not in request.files:
        return jsonify({"error": "No image provided"}), 400

    image_file = request.files['image']
    if image_file.filename == '':
        return jsonify({"error": "No selected image"}), 400

    try:
        # Basic image validation
        image = Image.open(image_file.stream)
        
        # Randomly choose between organic and inorganic for testing
        predicted_class_index = random.randint(0, 1)
        predicted_class = categories[predicted_class_index]
        
        # Generate dummy confidence scores
        confidence_scores = [0.0] * 2
        confidence_scores[predicted_class_index] = random.uniform(0.7, 0.95)
        # Fill other class with remaining confidence
        other_index = 1 - predicted_class_index
        confidence_scores[other_index] = 1 - confidence_scores[predicted_class_index]

        return jsonify({
            "status": "success",
            "prediction_number": predicted_class_index,
            "prediction_label": predicted_class["label"],
            "recycle_info": predicted_class["recycle_info"],
            "points_earned": predicted_class["points"],
            "confidence_score": confidence_scores[predicted_class_index] * 100,
            "raw_prediction": [confidence_scores],
            "message": "Dummy prediction for testing purposes"
        })

    except Exception as e:
        return jsonify({
            "error": f"Error processing image: {str(e)}",
            "status": "error"
        }), 500

# Add CORS support for development
@app.after_request
def after_request(response):
    response.headers.add('Access-Control-Allow-Origin', '*')
    response.headers.add('Access-Control-Allow-Headers', 'Content-Type,Authorization')
    response.headers.add('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE')
    return response

if __name__ == "__main__":
    port = int(os.environ.get("PORT", 5000))
    app.run(host="127.0.0.1", port=port, debug=True)