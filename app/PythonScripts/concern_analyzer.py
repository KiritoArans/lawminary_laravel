import spacy
import json
from transformers import MarianMTModel, MarianTokenizer

# Load the spaCy model
nlp = spacy.load("en_core_web_sm")

# Load MarianMT model and tokenizer for translation
model_name = 'Helsinki-NLP/opus-mt-tl-en'
tokenizer = MarianTokenizer.from_pretrained(model_name, clean_up_tokenization_spaces=True)
model = MarianMTModel.from_pretrained(model_name)

def translate_to_english(text):
    try:
        # Tokenize the text and translate it
        tokenized_text = tokenizer([text], return_tensors="pt", padding=True, truncation=True)
        translated = model.generate(**tokenized_text)
        translated_text = [tokenizer.decode(t, skip_special_tokens=True) for t in translated]
        return translated_text[0]
    except Exception as e:
        # Log the error to Laravel log or output it directly
        print(f"Error in translation: {e}")
        return f"Error in translation: {e}"

def process_concern(concern_text):
    try:
        # Translate Tagalog input to English
        translated_concern = translate_to_english(concern_text)

        if "Error" in translated_concern:
            return [translated_concern]

        # Process the translated text using spaCy
        doc = nlp(translated_concern)

        # Extract keywords
        keywords = [token.lemma_ for token in doc if token.pos_ in ['NOUN', 'VERB', 'PRON', 'ADJ', 'ADV', 'ADP', 'CCONJ', 'INTJ']]
        entities = [ent.text for ent in doc.ents]  # Named entities

        # Combine keywords and entities
        return keywords + entities

    except Exception as e:
        print(f"Error in processing: {e}")
        return [f"Error in processing: {e}"]

if __name__ == "__main__":
    import sys
    concern = sys.argv[1]
    result = process_concern(concern)

    # Output the result as JSON
    print(json.dumps(result))
