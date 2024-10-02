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

# Fetch concerns from tblposts
cursor = connection.cursor(dictionary=True)
cursor.execute("SELECT id, concern FROM tblposts")
concerns = cursor.fetchall()

# Fetch feedback from tblfeedbacks
cursor.execute("SELECT id, feedback FROM tblfeedbacks")
feedbacks = cursor.fetchall()

# Combine both concerns and feedbacks into one pool of "questions"
combined_data = []

# Add concerns to the pool
for concern in concerns:
    combined_data.append({'id': concern['id'], 'text': concern['concern'], 'type': 'concern'})

# Add feedbacks to the pool
for feedback in feedbacks:
    combined_data.append({'id': feedback['id'], 'text': feedback['feedback'], 'type': 'feedback'})

# Function to analyze and group related entries by semantic similarity
def analyze_faqs(faqs):
    doc_list = []
    grouped_faqs = defaultdict(list)

    # Process each text (concern or feedback) and convert to a SpaCy doc object
    for faq in faqs:
        text = faq['text']  # Use the combined text (either a concern or feedback)
        doc = nlp(text)  # Analyze the text with SpaCy
        doc_list.append((faq, doc))  # Store both the text and its doc object

    # Compare the similarity between texts
    threshold = 0.75  # Increase the threshold for more precise similarity
    for i, (faq_a, doc_a) in enumerate(doc_list):
        found_group = False
        for key, group in grouped_faqs.items():
            similarity_score = doc_a.similarity(nlp(key))
            if similarity_score > threshold:
                grouped_faqs[key].append(faq_a)
                found_group = True
                break
        if not found_group:
            grouped_faqs[faq_a['text']].append(faq_a)  # Create a new group
    
    # Sort the groups by the number of related questions (highest to lowest)
    sorted_grouped_faqs = sorted(grouped_faqs.items(), key=lambda x: len(x[1]), reverse=True)
    
    return sorted_grouped_faqs

# Analyze the combined concerns and feedbacks
grouped_faqs = analyze_faqs(combined_data)

# Prepare the output for Laravel
output = {
    key: [{'id': faq['id'], 'text': faq['text'], 'type': faq['type']} for faq in group]
    for key, group in grouped_faqs
}

# Print the output as JSON
print(json.dumps(output, indent=2))

# Close the database connection
cursor.close()
connection.close()
