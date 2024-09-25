import spacy
import json

# Load the spaCy model
nlp = spacy.load("en_core_web_sm")

def process_concern(concern_text):
    # Process the text using spaCy
    doc = nlp(concern_text)

    # Extract the nouns, verbs, and other key parts of speech
    keywords = [token.lemma_ for token in doc if token.pos_ in ['NOUN', 'VERB', 'PRON', 'ADJ', 'ADV', 'ADP', 'CCONJ', 'INTJ']]
    entities = [ent.text for ent in doc.ents]  # Named entities

    # Combine keywords and entities
    return keywords + entities

if __name__ == "__main__":
    import sys
    concern = sys.argv[1]
    result = process_concern(concern)

    # Output the result as JSON
    print(json.dumps(result))
