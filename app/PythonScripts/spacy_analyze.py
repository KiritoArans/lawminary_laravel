import spacy
import json
import mysql.connector
from collections import defaultdict
import warnings

warnings.filterwarnings("ignore", category=UserWarning)

# Load SpaCy model (English)
nlp = spacy.load("en_core_web_sm")

# Connect to the MySQL database
connection = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="lawminary_db"
)

# Fetch FAQs from tblposts table
cursor = connection.cursor(dictionary=True)
cursor.execute("SELECT id, concern FROM tblposts")
faqs = cursor.fetchall()

# Function to analyze text and group by semantic similarity
def analyze_faqs(faqs):
    doc_list = []
    grouped_faqs = defaultdict(list)

    # Process each FAQ's concern and convert to a SpaCy doc object
    for faq in faqs:
        doc = nlp(faq['concern'])
        doc_list.append((faq, doc))  # Store both the FAQ and its doc object

    # Compare the similarity between FAQ concerns
    threshold = 0.50  # Adjust this threshold for more or less similarity
    for i, (faq_a, doc_a) in enumerate(doc_list):
        found_group = False
        for key, group in grouped_faqs.items():
            similarity_score = doc_a.similarity(nlp(key))
            if similarity_score > threshold:
                grouped_faqs[key].append(faq_a)
                found_group = True
                break
        if not found_group:
            grouped_faqs[faq_a['concern']].append(faq_a)  # Create a new group
    
    # Sort the groups by the number of related questions (highest to lowest)
    sorted_grouped_faqs = sorted(grouped_faqs.items(), key=lambda x: len(x[1]), reverse=True)
    
    return sorted_grouped_faqs

# Analyze the FAQs
grouped_faqs = analyze_faqs(faqs)

# Prepare the output for Laravel
output = {
    key: [{'id': faq['id'], 'concern': faq['concern']} for faq in group] for key, group in grouped_faqs
}

# Print the output as JSON
print(json.dumps(output, indent=2))

# Close the database connection
cursor.close()
connection.close()
