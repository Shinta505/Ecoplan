from flask import Flask, request, jsonify
from tensorflow.keras.models import load_model
from PIL import Image
import numpy as np
import os

app = Flask(__name__)


MODEL_PATH = 'cnn_model_garbage_12_classes.h5'  


def load_model_from_local(model_path):
    if not os.path.exists(model_path):
        raise FileNotFoundError(f"Model file '{model_path}' not found.")
    return load_model(model_path)


model = load_model_from_local(MODEL_PATH)
categories = {
    # Organic categories
    1: {"label": "Organic", "recycle_info": "You can compost organic waste to make fertilizer."},
    4: {"label": "Organic", "recycle_info": "Biological waste can often be composted or processed into biogas."},
    8: {"label": "Organic", "recycle_info": "Paper can be composted or recycled to create new products."},
    3: {"label": "Organic", "recycle_info": "Cardboard can be composted or recycled to create new products."},

    # Inorganic categories
    13: {"label": "Inorganic", "recycle_info": "Plastic waste can be recycled to make new plastic products."},
    5: {"label": "Inorganic", "recycle_info": "Glass waste can be recycled to make new glass products."}, 
    6: {"label": "Inorganic", "recycle_info": "Glass waste can be recycled to make new glass products."},  
    0: {"label": "Inorganic", "recycle_info": "Batteries must be recycled at designated e-waste facilities to avoid environmental damage."},
    4: {"label": "Inorganic", "recycle_info": "Old clothes can be recycled or donated for reuse."},
    7: {"label": "Inorganic", "recycle_info": "Metal waste can be recycled to create new metal products."},
    9: {"label": "Inorganic", "recycle_info": "Plastic waste can be recycled to make new plastic products."},
    10: {"label": "Inorganic", "recycle_info": "Shoes can often be recycled or donated for reuse."},
    11: {"label": "Inorganic", "recycle_info": "Dispose of sanitary and medical waste according to local regulations."},
    2: {"label": "Inorganic", "recycle_info": "Glass waste can be recycled to make new glass products."},
    
}


@app.route('/')
def hello_world():
    return 'Hello, World!'

@app.route('/predict', methods=['POST'])
def predict():
    if 'image' not in request.files:
        return jsonify({"error": "No image provided"}), 400

    image_file = request.files['image']

    if image_file.filename == '':
        return jsonify({"error": "No selected image"}), 400

    try:
        image = Image.open(image_file.stream)

        image = image.resize((224, 224))  
        image_array = np.array(image)  

        if image_array.shape[-1] != 3:
            image_array = np.stack([image_array] * 3, axis=-1) 

        image_array = image_array / 255.0  

        image_array = np.expand_dims(image_array, axis=0)  

        prediction = model.predict(image_array)


        predicted_class_index = np.argmax(prediction)

        predicted_class = categories.get(predicted_class_index)

        if predicted_class:
            return jsonify({
                "prediction_number": int(predicted_class_index),
                "prediction_label": predicted_class["label"],
                "recycle_info": predicted_class["recycle_info"],
                "raw_prediction": prediction.tolist()  
            })
        else:
            return jsonify({"error": "Prediction category not found"}), 500

    except Exception as e:
        return jsonify({"error": str(e)}), 500

if __name__ == "__main__":
    app.run(host="127.0.0.1", port=5000)
