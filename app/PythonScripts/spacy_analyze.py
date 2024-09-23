import spacy
import json
import mysql.connector
from collections import Counter

# Load SpaCy model (English)
nlp = spacy.load("en_core_web_sm")

# Connect to the MySQL database
connection = mysql.connector.connect(
    host="localhost",       # Your database host
    user="root",            # Your database username
    password="",  # Your database password
    database="lawminary_db"   # Your database name
)

# Fetch FAQs from tblposts table
cursor = connection.cursor(dictionary=True)
cursor.execute("SELECT id, concern FROM tblposts")  # Adjust based on your table structure
faqs = cursor.fetchall()

# Function to analyze text and extract keywords
def analyze_faqs(faqs):
    analyzed_data = []
    all_keywords = []  # To store all keywords across all questions for frequency analysis
    
    for faq in faqs:
        doc = nlp(faq['concern'])  # Analyze the FAQ text using SpaCy
        
        # Extract keywords or entities (you can tweak this based on what you consider important)
        entities = [ent.text.lower() for ent in doc.ents]  # Lowercase entities for uniformity
        
        # If no entities found, tokenize the question to extract other important words
        if not entities:
            tokens = [token.text.lower() for token in doc if not token.is_stop and not token.is_punct]
            entities = tokens
        
        # Add the entities to the frequency list
        all_keywords.extend(entities)
        
        analyzed_data.append({
            "id": faq['id'],
            "concern": faq['concern'],
            "entities": entities
        })
    
    # Count the frequency of all keywords/entities
    keyword_counter = Counter(all_keywords)
    
    # Only keep FAQs with frequent keywords (frequency > 2)
    filtered_data = []
    for faq in analyzed_data:
        if any(keyword_counter[keyword] > 5 for keyword in faq['entities']):
            filtered_data.append(faq)
    
    return filtered_data

# Analyze the FAQs from the database
analyzed_faqs = analyze_faqs(faqs)

# Print the analyzed FAQs as JSON
print(json.dumps(analyzed_faqs, indent=2))

# Close the database connection
cursor.close()
connection.close()
