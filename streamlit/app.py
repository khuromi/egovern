import streamlit as st
import pandas as pd
import matplotlib.pyplot as plt
import scipy.stats as stats
import plotly.express as px
import requests

API_URL = 'http://localhost/egovern/api.php'

# Data Cleaning and Validation
def clean_data(data: pd.DataFrame) -> pd.DataFrame:
    """
    Cleans and validates the data.
    """
    # Drop rows where essential fields are missing
    essential_fields = ['Gender', 'Birthdate', 'Civil_Status', 'Employment_Status', 'Avg_Monthly_Income']
    data = data.dropna(subset=essential_fields)

    # Fill missing categorical data with 'Unknown'
    categorical_fields = ['Occupation', 'Educational_Attainment', 'Relation_To_Head', 'Sector_Code', 'Ethnicity', 'Mothers_Maiden_Name', 'Fathers_Name', 'Occupation', 'Qualifier', 'Sector_Code']
    for field in categorical_fields:
        data[field] = data[field].fillna('Unknown')

    # Convert data types
    data['Avg_Monthly_Income'] = pd.to_numeric(data['Avg_Monthly_Income'], errors='coerce')
    data['Household_Number'] = pd.to_numeric(data['Household_Number'], errors='coerce').fillna(0).astype(int)

    # Parse birthdate and calculate age
    data['Birthdate'] = pd.to_datetime(data['Birthdate'], errors='coerce')
    current_year = pd.to_datetime('today').year
    data['age'] = current_year - data['Birthdate'].dt.year

    # Drop rows with invalid Birthdates
    data = data.dropna(subset=['Birthdate', 'age'])

    return data

# Data Visualizations
#tab1 Demographics
def display_histogram(data: pd.DataFrame) -> None:
    st.subheader("Histogram: Data Distribution")
    col1, col2 = st.columns([20, 5])

    with col2:
        # Allow both string and numerical columns to be selected
        available_columns = data.columns.tolist()
        if not available_columns:
            st.warning("No columns available in the dataset.")
            return

        selected_column = st.selectbox("Select Column", available_columns, index=0)
        is_numeric = pd.api.types.is_numeric_dtype(data[selected_column])

        # If the column is numerical, allow bin adjustment
        if is_numeric:
            num_bins = st.slider("Number of Bins", min_value=5, max_value=50, value=20, step=5)
        else:
            num_bins = None

    try:
        with col1:
            if is_numeric:
                # Create histogram for numerical data
                fig = px.histogram(
                    data,
                    x=selected_column,
                    nbins=num_bins,
                    title=f"Histogram of {selected_column}",
                    labels={selected_column: selected_column},
                    color_discrete_sequence=["#636EFA"],
                    hover_data=data.columns,
                )
                fig.update_layout(
                    bargap=0.1,
                    xaxis_title=f"{selected_column}",
                    yaxis_title="Count",
                )
            else:
                # Create histogram for categorical data (value counts)
                value_counts = data[selected_column].value_counts().reset_index()
                value_counts.columns = [selected_column, "Count"]
                fig = px.bar(
                    value_counts,
                    x=selected_column,
                    y="Count",
                    title=f"Histogram of {selected_column}",
                    labels={selected_column: selected_column, "Count": "Counts"},
                    color_discrete_sequence=["#636EFA"],
                )
                fig.update_layout(
                    bargap=0,  # Ensure bars are intact (no gaps)
                    xaxis_title=f"{selected_column}",
                    yaxis_title="Counts",
                )

            st.plotly_chart(fig)

        with st.expander("See Evaluation"):
            col1, col2 = st.columns([4, 4])

        with col1:
            st.write("### Evaluation")
            st.write(f"*Selected Column:* {selected_column}")
            if is_numeric:
                st.write(f"*Number of Bins:* {num_bins}")

            st.write("### Summary Statistics:")
            if is_numeric:
                stats = data[selected_column].describe()
                for stat, value in stats.items():
                        st.write(f"{stat.capitalize()}: {value:,.2f}")
            else:
                total = len(data[selected_column])
                unique = data[selected_column].nunique()
                st.write(f"Total Entries: {total}")
                st.write(f"Unique Values: {unique}")

        with col2:
            st.write("### Insights")
            if is_numeric:
                st.write(f"- Minimum Value: {data[selected_column].min()}")
                st.write(f"- Maximum Value: {data[selected_column].max()}")
                st.write(f"- Range: {data[selected_column].max() - data[selected_column].min()}")
            else:
                st.write("### Top Categories:")
                for i, row in value_counts.iterrows():
                    st.write(f"- {row[selected_column]}: {row['Count']} occurrences")

    except ValueError as e:
        st.warning(f"An error occurred while generating the histogram: {str(e)}")

def display_treemap(data: pd.DataFrame) -> None:
    st.subheader("Treemap: Hierarchical Demographic Categories")
    col1, col2 = st.columns([20, 5])

    with col2:
        categorical_columns = data.select_dtypes(include='object').columns.tolist()
        selected_parent = st.selectbox("Select Parent Category", categorical_columns, index=4)  # Parent category (e.g., Age Group)
        selected_child = st.selectbox("Select Child Category", categorical_columns, index=9)  # Child category (e.g., Education Level)
    try:
        group_data = data.groupby([selected_parent, selected_child]).size().reset_index(name="Population")

        if group_data.empty:
            st.warning("No data available after applying the selected categories.")
            return

        with col1:
            fig = px.treemap(
                group_data,
                path=[selected_parent, selected_child],  
                values="Population",  
                color="Population",  
                hover_name=selected_child,
                title="Treemap: Hierarchical Demographic Categories",
                labels={selected_parent: selected_parent, selected_child: selected_child, "Population": "Population Size"},
                color_continuous_scale=px.colors.sequential.RdBu,  
            )
            st.plotly_chart(fig)

        with st.expander("See Evaluation"):
            col1, col2 = st.columns([4, 4])

        with col1:    
            st.write("### Evaluation")
            st.write(f"*Parent Category (selected):* {selected_parent}")
            st.write(f"*Child Category (selected):* {selected_child}")
            
            total_population = group_data["Population"].sum()
            st.write(f"*Total Population Represented:* {total_population:,}")
        
            st.write("### Population Breakdown:")
            st.write(group_data[[selected_parent, selected_child, "Population"]].sort_values(by="Population", ascending=False))

            if not group_data.empty:
                largest_group = group_data.loc[group_data["Population"].idxmax()]
                smallest_group = group_data.loc[group_data["Population"].idxmin()]
                st.write(f"*Largest Group:* {largest_group[selected_parent]} - {largest_group[selected_child]} | Population: {largest_group['Population']}")
                st.write(f"*Smallest Group:* {smallest_group[selected_parent]} - {smallest_group[selected_child]} | Population: {smallest_group['Population']}")

        with col2:
            st.write("### Category Distribution:")
            category_counts = group_data[selected_parent].value_counts()
            st.write(f"*Number of Unique Parent Categories:* {len(category_counts)}")
            st.write(category_counts)

            st.write("### Key Insights from Treemap:")
            for parent in category_counts.index:
                parent_data = group_data[group_data[selected_parent] == parent]
                st.write(f"- *Parent Category:* {parent}")
                for child in parent_data[selected_child].unique():
                    child_data = parent_data[parent_data[selected_child] == child]
                    st.write(f"   - *Child Category:* {child} | Population: {child_data['Population'].sum()}")
    except ValueError as e:
        if "cannot insert" in str(e):
                st.warning(f"An issue occurred while generating the treemap: {str(e)}")
        else:
            raise

def display_parallel_coordinates(data: pd.DataFrame) -> None:
    """
    Displays a dynamic Parallel Coordinates Plot with evaluation for multi-dimensional data analysis.
    """
    st.subheader("Parallel Coordinates Plot (Multi-Dimensional Analysis)")

    col1, col2 = st.columns([4, 1])

    with col2:
        # User input to select features for the plot
        numerical_columns = data.select_dtypes(include='number').columns.tolist()
        selected_columns = st.multiselect(
            "Select Columns for Parallel Coordinates Plot",
            numerical_columns,
            default=numerical_columns[:3]  # Pre-select the first 3 numerical columns
        )

        # Ensure at least 2 columns are selected for meaningful visualization
        if len(selected_columns) < 2:
            st.warning("Please select at least two columns to display the Parallel Coordinates Plot.")
            return

        # User input to filter data (optional)
        st.write("### Filter Data")
        min_values = {}
        max_values = {}
        filtered_data = data.copy()

        for col in selected_columns:
            # Get unique values to avoid slider errors when there is only one value in the column
            unique_values = data[col].dropna().unique()

            if len(unique_values) > 0:  # Ensure there are unique values available
                if len(unique_values) > 1:
                    # If there are multiple unique values, create a slider for filtering
                    col_min = float(data[col].min())
                    col_max = float(data[col].max())
                    min_values[col], max_values[col] = st.slider(
                        f"Filter {col} Range",
                        min_value=col_min,
                        max_value=col_max,
                        value=(col_min, col_max)
                    )
                    filtered_data = filtered_data[(filtered_data[col] >= min_values[col]) & (filtered_data[col] <= max_values[col])]
                else:
                    # If only one unique value exists, no slider needed
                    st.write(f"Only one value for {col}: {unique_values[0]}. No range filter needed.")
                    filtered_data = filtered_data[filtered_data[col] == unique_values[0]]
            else:
                # Handle case where there are no valid unique values (e.g., all NaN or empty)
                st.warning(f"No valid data available for column: {col}. Skipping filter.")
                filtered_data = filtered_data.drop(columns=[col])

        # Check if filtered_data is empty after applying filters
        if filtered_data.empty:
            st.warning("No data available after applying the filters.")
            return

    # Create the Parallel Coordinates Plot using Plotly
    with col1:
        fig = px.parallel_coordinates(
            filtered_data,
            dimensions=selected_columns,
            color=selected_columns[0],  # Use the first selected column for coloring
            color_continuous_scale=px.colors.diverging.RdBu,
            title="Parallel Coordinates Plot"
        )
        st.plotly_chart(fig)

    # Evaluation Section
    with st.expander("See Evaluation"):
        col1, col2 = st.columns([4, 4])

        with col1:
            st.write("### Evaluation")

            # 1. Data point count
            total_points = len(filtered_data)
            st.write(f"*Total Data Points (After Filtering):* {total_points}")

            # 2. Filtered ranges summary
            st.write(f"*Filtered Range per Selected Column:*")
            for col in selected_columns:
                if col in min_values and col in max_values:
                    st.write(f"- *{col}:* {min_values[col]} to {max_values[col]}")

            # 3. Key Insights
            st.write("### Key Insights")
            for col in selected_columns:
                col_mean = filtered_data[col].mean()
                col_std = filtered_data[col].std()
                st.write(
                    f"- *{col}:* Mean = {col_mean:.2f}, Std. Dev. = {col_std:.2f}, Min = {min_values.get(col, 'N/A')}, Max = {max_values.get(col, 'N/A')}"
                )

        with col2:
            # 4. Correlations (if more than 2 columns)
            if len(selected_columns) > 2:
                correlation_matrix = filtered_data[selected_columns].corr()
                st.write("### Correlation Matrix")
                st.dataframe(correlation_matrix.style.background_gradient(cmap='coolwarm'))

def display_bubble_chart(data: pd.DataFrame) -> None:
    """
    Displays a Bubble Chart to visualize population groups by size and variable.
    """
    st.subheader("Bubble Chart: Population Groups by Size and Variable")

    col1, col2 = st.columns([4, 1])

    with col2:
        # User input to select variables for the bubble chart
        numerical_columns = data.select_dtypes(include='number').columns.tolist()
        selected_x = st.selectbox("Select X-axis Variable", numerical_columns, index=0)  # X-axis (e.g., Age)
        selected_y = st.selectbox("Select Y-axis Variable", numerical_columns, index=1)  # Y-axis (e.g., Income)
        
        # User input to select a categorical variable for bubble size (e.g., Occupation or Employment Status)
        categorical_columns = data.select_dtypes(include='object').columns.tolist()
        selected_category = st.selectbox("Select Category for Bubble Size", categorical_columns, index=0)
     # Check if the user has selected the same variable for X and Y axes
    if selected_x == selected_y:
        st.warning("You have selected the same variable for both the X-axis and Y-axis. Please select different variables.")
        return  # Exit the function if the same variable is selected
    # Group the data by the selected category (e.g., Employment Status)
    # Count the number of individuals in each category to represent the bubble size
    group_data = data.groupby([selected_x, selected_y, selected_category]).size().reset_index(name="Population")
    # Create the Bubble Chart using Plotly
    with col1:
        fig = px.scatter(
            group_data,
            x=selected_x,
            y=selected_y,
            size="Population",  # Bubble size based on population count
            color=selected_category,  # Color by the selected category
            hover_name=selected_category,
            title="Bubble Chart: Population Groups by Size and Variable",
            labels={selected_x: selected_x, selected_y: selected_y, "Population": "Population Size"},
            template="plotly",
            color_continuous_scale=px.colors.sequential.Inferno,  # Choose color scale
        )

        # Show the bubble chart
        st.plotly_chart(fig)

    # Evaluation Section
    with st.expander("See Evaluation"):
        col1, col2 = st.columns([4, 4])

    with col1:    
        st.write("### Evaluation")

        # 1. *General Summary*
        st.write(f"*X-axis (selected):* {selected_x}")
        st.write(f"*Y-axis (selected):* {selected_y}")
        st.write(f"*Bubble Size (selected):* {selected_category}")
        
        # 2. *Population Size Evaluation*
        total_population = group_data["Population"].sum()
        st.write(f"*Total Population Represented:* {total_population:,}")
        
        # 3. *Bubble Size Distribution*
        st.write("### Bubble Size Distribution (Population Size):")
        st.write(f"*Minimum Population Size in Group:* {group_data['Population'].min()}")
        st.write(f"*Maximum Population Size in Group:* {group_data['Population'].max()}")
        st.write(f"*Average Population Size in Group:* {group_data['Population'].mean():.2f}")
        st.write(f"*Standard Deviation of Population Size:* {group_data['Population'].std():.2f}")

        # *Correlation Analysis* (if applicable)
        if len(group_data[selected_x].unique()) > 1 and len(group_data[selected_y].unique()) > 1:
            correlation, _ = stats.pearsonr(group_data[selected_x], group_data[selected_y])
            st.write(f"### Correlation between {selected_x} and {selected_y}:")
            st.write(f"*Pearson Correlation Coefficient:* {correlation:.2f}")

    with col2:
        # 4. *Category Breakdown*
        st.write("### Category Breakdown by Selected Variable:")
        category_counts = group_data[selected_category].value_counts()
        st.write(category_counts)

        # 5. *Key Insights*
        st.write("### Key Insights from Bubble Chart:")
        # Check for possible patterns in the bubble chart by looking at the categories
        for category in category_counts.index:
            category_data = group_data[group_data[selected_category] == category]
            x_avg = category_data[selected_x].mean()
            y_avg = category_data[selected_y].mean()
            st.write(f"- *Category:* {category} | Average {selected_x}: {x_avg:.2f} | Average {selected_y}: {y_avg:.2f}")        

def display_population_pyramid(data: pd.DataFrame) -> None:
    """
    Displays a population pyramid for age and gender distribution with evaluation.
    The population pyramid should update based on the filtered data.
    """
    st.subheader("Population Pyramid (Age and Gender Distribution)")

    if data.empty or data['age'].isna().all() or data['Gender'].isna().all():
        st.warning("No sufficient data available to display the population pyramid for the selected filters.")
        return

        # Prepare data for the pyramid
    pyramid_data = data[['age', 'Gender']].copy()

        # Handle age groups dynamically based on data range
    age_min = int(data['age'].min())
    age_max = int(data['age'].max())
    age_bins = list(range(age_min, age_max + 10, 10))  # 10-year bins

    pyramid_data['age_group'] = pd.cut(
        pyramid_data['age'],
        bins=age_bins,
        right=False,
        labels=[f"{i}-{i + 9}" for i in range(age_min, age_max, 10)]
    )
    pyramid_data = pyramid_data.groupby(['age_group', 'Gender']).size().reset_index(name='count')

    if pyramid_data.empty:
        st.warning("No sufficient data available to display the population pyramid for the selected filters.")
        return

    # Pivot to format suitable for the pyramid
    pyramid_data = pyramid_data.pivot(index='age_group', columns='Gender', values='count').fillna(0)
    
     # Ensure 'Male' and 'Female' columns exist
    if 'Male' not in pyramid_data.columns:
        pyramid_data['Male'] = 0
    if 'Female' not in pyramid_data.columns:
        pyramid_data['Female'] = 0
    
    pyramid_data = pyramid_data[['Male', 'Female']].reset_index()  # Ensure consistent gender order
    pyramid_data['Male'] = -pyramid_data['Male']  # Negative values for the male side

        # Plot the pyramid
    fig, ax = plt.subplots(figsize=(20, 6))
    ax.barh(pyramid_data['age_group'], pyramid_data['Male'], color='blue', label='Male')
    ax.barh(pyramid_data['age_group'], pyramid_data['Female'], color='pink', label='Female')
    ax.set_xlabel("Population")
    ax.set_ylabel("Age Group")
    ax.set_title("Population Pyramid")
    ax.legend()
    st.pyplot(fig)

    with st.expander("See Evaluation"):
        st.write("### Evaluation")
        
        # Calculate male-to-female ratio
        total_male = abs(pyramid_data['Male'].sum())
        total_female = pyramid_data['Female'].sum()
        male_to_female_ratio = total_male / total_female if total_female > 0 else 0
        
        st.write(f"*Total Male Population:* {total_male}")
        st.write(f"*Total Female Population:* {total_female}")
        st.write(f"*Male-to-Female Ratio:* {male_to_female_ratio:.2f}:1")
        
        # Identify largest age group by gender
        largest_male_group = pyramid_data.loc[pyramid_data['Male'].idxmin(), 'age_group']
        largest_female_group = pyramid_data.loc[pyramid_data['Female'].idxmax(), 'age_group']

        st.write(f"*Largest Male Age Group:* {largest_male_group}")
        st.write(f"*Largest Female Age Group:* {largest_female_group}")

def display_demographics(data: pd.DataFrame) -> None:
    """
    Displays scatter plot of Age vs. Average Monthly Income and evaluation.
    """
    st.subheader("Scatter Plot: Age vs. Income")
    
    # Clean the data for scatter plot (drop rows with NaN values in relevant columns)
    clean_data = data[['age', 'Avg_Monthly_Income']].dropna()

    # Check if there are enough data points
    if len(clean_data) < 2:
        st.warning("Not enough data points after filtering. Please adjust your filter settings.")
        return

    # Scatter plot
    fig, ax = plt.subplots(figsize=(10, 4))
    ax.scatter(clean_data['age'], clean_data['Avg_Monthly_Income'], alpha=0.5, color='blue', edgecolors='black')
    ax.set_xlabel("Age")
    ax.set_ylabel("Average Monthly Income")
    ax.set_title("Age vs. Income")
    st.pyplot(fig)

    # Conditionally render the expander
    if len(clean_data) >= 2:
        with st.expander("See Evaluation"):
            st.write("### Evaluation")
            
            # Correlation evaluation
            correlation, _ = stats.pearsonr(clean_data['age'], clean_data['Avg_Monthly_Income'])
            st.write(f"*Pearson Correlation Coefficient:* {correlation:.2f}")

            # Check if 'age' has more than one unique value before performing linear regression
            if clean_data['age'].nunique() > 1:
                # Perform regression if there is variability in 'age'
                slope, intercept, r_value, p_value, std_err = stats.linregress(clean_data['age'], clean_data['Avg_Monthly_Income'])
                st.write(f"*Regression Line:* y = {slope:.2f}x + {intercept:.2f}")
                st.write(f"*R-squared Value:* {r_value**2:.2f}")

                # Plot the regression line
                st.write("### Regression Line")
                fig2, ax2 = plt.subplots(figsize=(10, 4))
                ax2.scatter(clean_data['age'], clean_data['Avg_Monthly_Income'], alpha=0.5, color='blue', edgecolors='black')
                ax2.plot(clean_data['age'], slope * clean_data['age'] + intercept, color='red', linewidth=2, label='Regression Line')
                ax2.set_xlabel("Age")
                ax2.set_ylabel("Average Monthly Income")
                ax2.set_title("Age vs. Income with Regression Line")
                ax2.legend()
                st.pyplot(fig2)
            else:
                st.warning("Cannot calculate linear regression. All 'age' values are identical.")

def display_correlation_heatmap(data: pd.DataFrame) -> None:
    st.subheader("Correlation Heatmap of SES Variables")
    col1, col2 = st.columns([4,1])

    with col2:
        # Select only numeric columns
        numeric_columns = data.select_dtypes(include=["number"]).columns.tolist()

        if len(numeric_columns) < 2:
            st.warning("Not enough numeric columns to compute correlation.")
            return

        # Allow the user to select SES-related fields
        selected_columns = st.multiselect(
            "Select SES Variables for Correlation",
            options=numeric_columns,
            default=numeric_columns,
        )

        if len(selected_columns) < 2:
            st.warning("Please select at least two variables.")
            return

    with col1:
        # Compute correlation matrix
        correlation_matrix = data[selected_columns].corr()

        # Plot heatmap using Plotly
        try:
            fig = px.imshow(
                correlation_matrix,
                text_auto=True,
                color_continuous_scale="Viridis",
                title="Correlation Heatmap of SES Variables",
                labels=dict(color="Correlation"),
            )
            st.plotly_chart(fig)
        except Exception as e:
            st.error(f"Error creating heatmap: {e}")    

    with st.expander("See Visualization"):
        # Evaluation of Correlation
        st.subheader("Correlation Evaluation:")
        for column in selected_columns:
            st.write(f"*Evaluation for {column}:*")
            for other_column in selected_columns:
                if column != other_column:
                    correlation_value = correlation_matrix.loc[column, other_column]
                    evaluation = interpret_correlation(correlation_value)
                    st.write(f" - Correlation with {other_column}: {correlation_value:.2f} ({evaluation})")

def interpret_correlation(correlation_value: float) -> str:
    """
    Interprets the correlation coefficient and returns an evaluation string.
    """
    if correlation_value > 0.8:
        return "Strong Positive Correlation"
    elif 0.5 < correlation_value <= 0.8:
        return "Moderate Positive Correlation"
    elif 0.2 < correlation_value <= 0.5:
        return "Weak Positive Correlation"
    elif -0.2 < correlation_value <= 0.2:
        return "No Correlation"
    elif -0.5 <= correlation_value < -0.2:
        return "Weak Negative Correlation"
    elif -0.8 <= correlation_value < -0.5:
        return "Moderate Negative Correlation"
    else:
        return "Strong Negative Correlation"
    
def display_stacked_bar_chart(data: pd.DataFrame) -> None:
    st.subheader("Stacked Bar Chart: Distribution of Residents per Sector")

    # Filter and prepare relevant sectors
    sector_counts = data['Sector_Code'].value_counts()

    # List of relevant sectors
    target_sectors = ["Senior", "4P's", "PWD", "Solo Parent", "Farmers"]

    # Ensure only available sectors are included
    available_sectors = [sector for sector in target_sectors if sector in sector_counts.index]
    relevant_sectors = sector_counts.loc[available_sectors]

    # Check if there are numeric values to plot
    if relevant_sectors.empty:
        st.warning("No data available for the selected sectors.")
        return

    # Create a DataFrame for the stacked bar chart
    stacked_data = pd.DataFrame({
        "Residents": relevant_sectors.values
    }, index=relevant_sectors.index).T  # Transpose for horizontal stacking

    # Horizontal stacked bar chart
    fig, ax = plt.subplots(figsize=(10, 6))
    stacked_data.plot(kind='barh', stacked=True, ax=ax, color=['skyblue', 'orange', 'green', 'purple', 'brown'][:len(available_sectors)])

    # Add labels and titles
    ax.set_xlabel("Number of Residents")
    ax.set_ylabel("Sector")
    ax.set_title("Distribution of Residents per Sector (Horizontal Stacked)")
    ax.legend(title="Sector", bbox_to_anchor=(1.05, 1), loc='upper left')
    plt.tight_layout()
    st.pyplot(fig)

    with st.expander("See Evaluation"):
        st.write("### Evaluation")
        total_residents = relevant_sectors.sum()
        st.write(f"*Total Residents in Selected Sectors:* {total_residents}")
        st.write("### Sector Breakdown:")
        for sector, count in relevant_sectors.items():
            st.write(f"- {sector}: {count} residents")

## Streamlit App Layout
# Set Streamlit page configuration
st.set_page_config(page_title="eGovern", layout="wide")

# App Title and Description
st.title("Exploratory Data Visualization ")
st.markdown("""
Welcome to the eGovern Residents Data Dashboard. Use the sidebar to filter the data based on various criteria and explore different aspects of the residents' demographics and socioeconomic status.
""")

def load_json():
    try:
        # Fetch data from the API
        response = requests.get(API_URL)
        response.raise_for_status()  # Raise an error if the request was unsuccessful
        json_data = response.json()

        # Convert JSON data into a pandas DataFrame
        data = pd.DataFrame(json_data)
        return data
    except requests.exceptions.RequestException as e:
        st.error(f"Error fetching data from API: {e}")
        st.stop()

# Load data from the API
data = load_json()

if not data.empty:
    st.write("### Fetched Data:")
    st.dataframe(data)

    # Clean and validate data (assuming a clean_data function exists)
    data = clean_data(data)

    # Sidebar Filters
    st.sidebar.header("Filter Residents Data")
    sex = st.sidebar.selectbox(
        "Gender",
        options=["All"] + sorted(data['Gender'].dropna().unique().tolist()),
        help="Filter residents by gender."
    )
    civil_status = st.sidebar.selectbox(
        "Civil Status",
        options=["All"] + sorted(data['Civil_Status'].dropna().unique().tolist()),
        help="Filter residents by civil status."
    )
    employment_status = st.sidebar.selectbox(
        "Employment Status",
        options=["All"] + sorted(data['Employment_Status'].unique().tolist()),
        help="Filter residents by employment status."
    )
    education = st.sidebar.multiselect(
        "Educational Attainment",
        options=sorted(data['Educational_Attainment'].dropna().unique().tolist()),
        default=sorted(data['Educational_Attainment'].dropna().unique().tolist()),
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
        data = data[data['Gender'] == sex]
    if civil_status != "All":
        data = data[data['Civil_Status'] == civil_status]
    if employment_status != "All":
        data = data[data['Employment_Status'] == employment_status]
    if education:
        data = data[data['Educational_Attainment'].isin(education)]
    data = data[(data['age'] >= age_range[0]) & (data['age'] <= age_range[1])]

    st.write(f"**Total Records:** {len(data)}")

    # Display visualizations using tabs
    tab1, tab2 = st.tabs([
        "Demographics",
        "Socioeconomic Status"
    ])

    with tab1:
        display_histogram(data)
        display_population_pyramid(data)
        display_treemap(data)
        display_bubble_chart(data)
        display_parallel_coordinates(data)

    with tab2:
        display_correlation_heatmap(data)
        display_demographics(data)

else:
    st.info("No data available.")