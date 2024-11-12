import streamlit as st
import mariadb
import pandas as pd
from dotenv import load_dotenv
import os
import logging
import matplotlib.pyplot as plt

# Configure logging
logging.basicConfig(
    filename='app.log',
    filemode='a',
    format='%(asctime)s - %(levelname)s - %(message)s',
    level=logging.INFO
)

# Load environment variables
load_dotenv()

DB_HOST = os.getenv("DB_HOST", "127.0.0.1")
DB_USER = os.getenv("DB_USER", "root")
DB_PASSWORD = os.getenv("DB_PASSWORD", "")
DB_NAME = os.getenv("DB_NAME", "egovern")

# Database connection pooling using MariaDB Connector/Python
@st.cache_resource
def get_database_connection_pool():
    """
    Initializes and returns a MariaDB connection pool.
    """
    try:
        pool = mariadb.ConnectionPool(
            pool_name="mypool",
            pool_size=5,
            host=DB_HOST,
            user=DB_USER,
            password=DB_PASSWORD,
            database=DB_NAME
        )
        logging.info("MariaDB connection pool created successfully.")
        return pool
    except mariadb.Error as err:
        logging.error(f"Database connection error: {err}")
        st.error("Failed to connect to the database. Please check your credentials and database configuration.")
        return None

# Fetch data from the database
@st.cache_data
def fetch_data():
    """
    Fetches data from the residents table in the database.
    """
    pool = get_database_connection_pool()
    if pool:
        try:
            connection = pool.get_connection()
            cursor = connection.cursor(dictionary=True)
            query = "SELECT * FROM residents"
            cursor.execute(query)
            rows = cursor.fetchall()
            df = pd.DataFrame(rows)
            cursor.close()
            connection.close()  # Returns the connection to the pool
            if df.empty:
                st.warning("No data retrieved from the database.")
            logging.info("Data fetched successfully from the database.")
            return df
        except mariadb.Error as e:
            logging.error(f"Error fetching data: {e}")
            st.error("An error occurred while fetching data from the database.")
    else:
        st.error("Connection pool is not available.")
    return pd.DataFrame()

# Data Cleaning and Validation
def clean_data(data: pd.DataFrame) -> pd.DataFrame:
    """
    Cleans and validates the data.
    """
    # Drop rows where essential fields are missing
    essential_fields = ['sex', 'birthdate', 'civil_status', 'employment_status', 'avg_monthly_income']
    data = data.dropna(subset=essential_fields)

    # Fill missing categorical data with 'Unknown'
    categorical_fields = ['occupation', 'educational_attainment', 'household_head_relationship', 'sector_code', 'ethnicity']
    for field in categorical_fields:
        data[field] = data[field].fillna('Unknown')

    # Convert data types
    data['avg_monthly_income'] = pd.to_numeric(data['avg_monthly_income'], errors='coerce')
    data['household_number'] = pd.to_numeric(data['household_number'], errors='coerce').fillna(0).astype(int)

    # Parse birthdate and calculate age
    data['birthdate'] = pd.to_datetime(data['birthdate'], errors='coerce')
    current_year = pd.to_datetime('today').year
    data['age'] = current_year - data['birthdate'].dt.year

    # Drop rows with invalid birthdates
    data = data.dropna(subset=['birthdate', 'age'])

    return data

# Data Visualizations
def display_demographics(data: pd.DataFrame) -> None:
    """
    Displays demographic charts including gender distribution, age distribution, and civil status breakdown.
    """
    st.subheader("Demographics")

    st.write("### Gender Distribution")
    gender_counts = data['sex'].value_counts()
    st.bar_chart(gender_counts)

    st.write("### Age Distribution")
    display_age_distribution_matplotlib(data)

    st.write("### Civil Status Breakdown")
    civil_status_counts = data['civil_status'].value_counts()
    st.bar_chart(civil_status_counts)

def display_age_distribution_matplotlib(data: pd.DataFrame) -> None:
    """
    Displays age distribution using Matplotlib.
    """
    fig, ax = plt.subplots()
    ax.hist(data['age'].dropna(), bins=10, color='skyblue', edgecolor='black')
    ax.set_xlabel('Age')
    ax.set_ylabel('Frequency')
    ax.set_title('Age Distribution of Residents')
    st.pyplot(fig)

def display_socioeconomic_status(data: pd.DataFrame) -> None:
    """
    Displays socioeconomic status charts including employment status, income distribution, and top occupations.
    """
    st.subheader("Socioeconomic Status")

    st.write("### Employment Status")
    employment_counts = data['employment_status'].value_counts()
    st.bar_chart(employment_counts)

    st.write("### Monthly Income Distribution")
    display_income_distribution_matplotlib(data)

    st.write("### Top 10 Occupations")
    top_occupations = data['occupation'].value_counts().head(10)
    st.bar_chart(top_occupations)

def display_income_distribution_matplotlib(data: pd.DataFrame) -> None:
    """
    Displays monthly income distribution using Matplotlib.
    """
    fig, ax = plt.subplots()
    ax.hist(data['avg_monthly_income'].dropna(), bins=10, color='lightgreen', edgecolor='black')
    ax.set_xlabel('Average Monthly Income')
    ax.set_ylabel('Frequency')
    ax.set_title('Monthly Income Distribution')
    st.pyplot(fig)

def display_education(data: pd.DataFrame) -> None:
    """
    Displays educational attainment chart.
    """
    st.subheader("Educational Attainment")
    education_counts = data['educational_attainment'].value_counts()
    st.bar_chart(education_counts)

def display_household_info(data: pd.DataFrame) -> None:
    """
    Displays household information charts including household size and head relationships.
    """
    st.subheader("Household Information")

    st.write("### Household Size Distribution")
    household_counts = data['household_number'].value_counts()
    st.bar_chart(household_counts)

    st.write("### Household Head Relationships")
    head_relationship_counts = data['household_head_relationship'].value_counts()
    st.bar_chart(head_relationship_counts)

def display_sector_representation(data: pd.DataFrame) -> None:
    """
    Displays sector representation chart.
    """
    st.subheader("Sector Representation")
    sector_counts = data['sector_code'].value_counts()
    st.bar_chart(sector_counts)

def display_ethnicity(data: pd.DataFrame) -> None:
    """
    Displays ethnicity distribution chart.
    """
    st.subheader("Ethnicity Distribution")
    ethnicity_counts = data['ethnicity'].value_counts()
    st.bar_chart(ethnicity_counts)

# Streamlit App Layout
st.title("eGovern Residents Data Dashboard")
st.markdown("""
Welcome to the eGovern Residents Data Dashboard. Use the sidebar to filter the data based on various criteria and explore different aspects of the residents' demographics and socioeconomic status.
""")

# Fetch data with a loading spinner
with st.spinner('Loading data...'):
    data = fetch_data()

if not data.empty:
    # Clean and validate data
    data = clean_data(data)

    # Sidebar Filters
    st.sidebar.header("Filter Residents Data")
    sex = st.sidebar.selectbox(
        "Sex",
        options=["All"] + sorted(data['sex'].dropna().unique().tolist()),
        help="Filter residents by sex."
    )
    civil_status = st.sidebar.selectbox(
        "Civil Status",
        options=["All"] + sorted(data['civil_status'].dropna().unique().tolist()),
        help="Filter residents by civil status."
    )
    employment_status = st.sidebar.selectbox(
        "Employment Status",
        options=["All"] + sorted(data['employment_status'].dropna().unique().tolist()),
        help="Filter residents by employment status."
    )
    education = st.sidebar.multiselect(
        "Educational Attainment",
        options=sorted(data['educational_attainment'].dropna().unique().tolist()),
        default=sorted(data['educational_attainment'].dropna().unique().tolist()),
        help="Filter residents by educational attainment."
    )
    age_range = st.sidebar.slider(
        "Age Range",
        min_value=int(data['age'].min()),
        max_value=int(data['age'].max()),
        value=(int(data['age'].min()), int(data['age'].max())),
        help="Filter residents by age range."
    )

    # Apply filters
    if sex != "All":
        data = data[data['sex'] == sex]
    if civil_status != "All":
        data = data[data['civil_status'] == civil_status]
    if employment_status != "All":
        data = data[data['employment_status'] == employment_status]
    if education:
        data = data[data['educational_attainment'].isin(education)]
    data = data[(data['age'] >= age_range[0]) & (data['age'] <= age_range[1])]

    # Pagination (Optional)
    page_size = 100
    total_pages = (len(data) // page_size) + 1
    page = st.sidebar.number_input("Page", min_value=1, max_value=total_pages, value=1, step=1)
    start_idx = (page - 1) * page_size
    end_idx = start_idx + page_size
    st.write("### Filtered Resident Data", data.iloc[start_idx:end_idx])

    # Display visualizations using tabs
    tab1, tab2, tab3, tab4, tab5, tab6 = st.tabs([
        "Demographics",
        "Socioeconomic Status",
        "Educational Attainment",
        "Household Information",
        "Sector Representation",
        "Ethnicity Distribution"
    ])

    with tab1:
        display_demographics(data)
    with tab2:
        display_socioeconomic_status(data)
    with tab3:
        display_education(data)
    with tab4:
        display_household_info(data)
    with tab5:
        display_sector_representation(data)
    with tab6:
        display_ethnicity(data)
else:
    st.warning("No data found or unable to connect to the database. Please check your connection or database.")
