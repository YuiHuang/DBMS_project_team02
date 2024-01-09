import pickle
import pandas as pd
from pathlib import Path  

#ingr
with open('raw_data/ingr_map.pkl', 'rb') as f:
    df = pickle.load(f)
df = df[["id", "replaced"]]
df = df.drop_duplicates()
df = df.sort_values(by=['id'])

filepath = Path('processed_data/ingr.csv')  
filepath.parent.mkdir(parents=True, exist_ok=True)  
df.to_csv(filepath, index = False, header = False)


#rcp_info
df = pd.read_csv('raw_data/RAW_recipes.csv')
df = df[["id", "name", "minutes"]]
df = df.sort_values(by=['id'])

filepath = Path('processed_data/rcp_info.csv')  
filepath.parent.mkdir(parents=True, exist_ok=True)  
df.to_csv(filepath, index = False, header = False)


#rcp_ingr
df = pd.read_csv('raw_data/PP_recipes.csv')
df = df[["id", "ingredient_ids"]]
df = df.sort_values(by=['id'])
df = df.reset_index(drop = True)

data = []
for i in range(len(df)):
    rcp_id = df.loc[i, 'id']
    ingredient_ids = df.loc[i, 'ingredient_ids'][1:-1].split(',')
    ingredient_ids = sorted([int(i) for i in ingredient_ids])
    for j in ingredient_ids:
        data.append([rcp_id, j])
df2 = pd.DataFrame(data, columns=['rcp_id', 'ingr_id'])

filepath = Path('processed_data/rcp_ingr.csv')
filepath.parent.mkdir(parents=True, exist_ok=True)  
df2.to_csv(filepath, index = False, header = False)