# Using plotly.express
import plotly.express as px
import plotly.io as pio

import pandas as pd
df = pd.read_excel('C:/Users/ASUS/Downloads/DataUdara.xlsx')

fig = px.line(df, x='Date', y='RH', hover_data=['Time', 'CO(GT)', 'PT08.S1(CO)', 'NMHC(GT)', 'C6H6(GT)', 'PT08.S2(NMHC)', 'NOx(GT)', 'PT08.S3(NOx)', 'NO2(GT)', 'PT08.S4(NO2)', 'PT08.S5(O3)', 'T', 'AH'])

try:
    pio.write_html(fig, file='timeseries.html', auto_open=False)
    print(True)
except:
    print(False)